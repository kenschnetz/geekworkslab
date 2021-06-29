<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use App\Models\PostComment as PostCommentModel;
    use App\Utilities\Misc;
    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class PostView extends Component {
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
        public string $default_image_url = '/storage/post-images/default-placeholder.png';
        protected $listeners = ['ReplyingTo' => 'ReplyingTo', 'EditComment' => 'EditComment'];

        public function Mount() {
            $this->user_id = Auth::id();
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
            $this->reset('comment_id', 'post_comment_id', 'comment_content', 'replying_to_name', 'replying_to_content', 'editing', 'replying');
        }

        public function CommentDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function Render() {
            $post = PostModel::where('slug', $this->post_slug)
                ->with('User', 'Images', 'Contributors', 'Tags', 'PostAttributes', 'Comments', 'Upvotes')
                ->withCount('AllComments', 'Upvotes')
                ->first();
            $this->post_id = $post->id;
            return view('livewire.post-view')->with(['post' => $post]);
        }
    }
