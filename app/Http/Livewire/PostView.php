<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use App\Models\PostView as PostViewModel;
    use App\Models\PostComment as PostCommentModel;
    use App\Models\PostUpvote as PostUpvoteModel;
    use App\Utilities\Misc;
    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Livewire\WithPagination;

    class PostView extends Component {
        use WithPagination;

        public int|null $comment_id = null;
        public int|null $post_comment_id = null;
        public string $comment_content = '';
        public string $replying_to_name = '';
        public string $replying_to_content = '';
        public bool $editing = false;
        public bool $replying = false;
        public int|null $user_id;
        public int|null $post_id;
        public string $post_slug;
        public int|null $views;
        public bool|null $upvoted;
        public string $default_image_url = '/img/default-placeholder.png';
        protected $listeners = ['ReplyingTo' => 'ReplyingTo', 'EditComment' => 'EditComment', 'DeleteComment' => 'DeleteComment'];

        public function Mount() {
            $this->user_id = Auth::id();
            $post_view = PostViewModel::where('user_id', $this->user_id)->where('post_id', $this->post_id)->first();
            if (empty($post_view)) {
                $post_view = new PostViewModel;
                $post_view->user_id = $this->user_id;
                $post_view->post_id = $this->post_id;
                $post_view->count = 1;
            } else {
                $post_view->increment('count');
            }
            $post_view->save();
        }

        public function Upvote() {
            PostUpvoteModel::updateOrCreate(
                [ 'post_id' => $this->post_id, 'user_id' => Auth::id() ],
                [ 'post_id' => $this->post_id, 'user_id' => Auth::id() ]
            );
        }

        public function CancelUpvote() {
            PostUpvoteModel::where('post_id', $this->post_id)->where('user_id', Auth::id())->delete();
        }

        public function EditComment($id, $post_comment_id, $content) {
            $this->editing = true;
            $this->comment_id = $id;
            $this->post_comment_id = $post_comment_id;
            $this->comment_content = $content;
        }

        public function ReplyingTo($id, $name, $content) {
            $this->replying = true;
            $this->post_comment_id = $id;
            $this->replying_to_name = $name;
            $this->replying_to_content = $content;
        }

        public function SubmitComment() {
            PostCommentModel::updateOrCreate(
                ['id' => $this->comment_id],
                [
                    'post_id' => $this->post_id,
                    'user_id' => $this->user_id,
                    'post_comment_id' => $this->post_comment_id,
                    'content' => $this->comment_content
                ]
            );
            $this->emit('CommentsUpdated');
            $this->ClearCommentForm();
        }

        public function DeleteComment($id) {
            PostCommentModel::where('id', $id)->delete();
            $this->emit('CommentsUpdated');
        }

        public function ClearCommentForm() {
            $this->reset('comment_id', 'post_comment_id', 'comment_content', 'replying_to_name', 'replying_to_content', 'editing', 'replying');
        }

        public function CommentDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function DeletePost($id) {
            PostModel::where('id', $id)->delete();
            redirect()->route('dashboard');
        }

        public function ModeratePost($id) {
            $post = PostModel::where('id', $id)->first();
            if (!empty($post)) {
                $post->moderated = true;
                $post->save();
                return redirect(request()->header('Referer'));
            }
        }

        public function ReinstatePost($id) {
            $post = PostModel::where('id', $id)->first();
            if (!empty($post)) {
                $post->moderated = false;
                $post->save();
                return redirect(request()->header('Referer'));
            }
        }

        public function Icon($category_id) {
            return match($category_id) {
                1 => 'items',
                2 => 'monsters',
                3 => 'hooks',
                4 => 'abilities',
                5 => 'misc',
            };
        }

        public function Render() {
            $post = PostModel::where('slug', $this->post_slug)
                ->with('User', 'Images', 'Contributors', 'Tags', 'Attributes', 'Upvotes')
                ->withCount('AllComments', 'Upvotes')
                ->first();
            $this->post_id = $post->id;
            $views = $this->views = $post->ViewCount();
            $upvoted = $this->upvoted = PostUpvoteModel::where('post_id', $this->post_id)->where('user_id', Auth::id())->exists();
            return view('livewire.post-view')->with(['post' => $post, 'comments' => $post->Comments()->paginate(10), 'upvoted' => $upvoted, 'views' => $views]);
        }
    }
