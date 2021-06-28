<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use App\Models\PostComment as PostCommentModel;
    use App\Utilities\Misc;
    use App\Utilities\Misc as MiscUtilities;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Livewire\Component;

    class PostView extends Component {
        public int|null $responding_to_id = null;
        public string|null $responding_to_name = "";
        public string|null $responding_to_content = "";
        public int|null $editing_id = null;
        public int|null $editing_parent_id = null;
        public string $comment_content = "";
        public int|null $user_id;
        public int|null $post_id;
        public string $post_slug;
        public string $default_image_url = '/storage/post-images/default-placeholder.png';
        protected $listeners = ['RespondingTo' => 'RespondingTo', 'EditComment' => 'EditComment', 'CommentPosted' => '$refresh'];

        public function Mount() {
            $this->user_id = Auth::id();
        }

        public function CommentDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function RespondingTo($id, $name, $content) {
            $this->CommentClear();
            $this->responding_to_id = $id;
            $this->responding_to_name = $name;
            $this->responding_to_content = $content;
        }

        public function EditComment($id, $content, $post_comment_id = null) {
            $this->editing_id = $id;
            $this->comment_content = $content;
            $this->editing_parent_id = $post_comment_id;
        }

        public function CancelRespondingTo() {
            $this->CommentClear();
        }

        public function SubmitComment() {
            PostCommentModel::updateOrCreate([
                'id' => $this->editing_id
            ], [
                'post_id' => $this->post_id,
                'user_id' => $this->user_id,
                'post_comment_id' => empty($this->editing_id) ? $this->responding_to_id : $this->editing_parent_id,
                'content' => $this->comment_content,
            ]);

            if(!empty($this->responding_to_id)) {
                $this->emit('CommentsUpdated');
            }
            $this->CommentClear();
            $this->Render();
        }

        public function CommentClear() {
            $this->reset('responding_to_id', 'responding_to_name', 'responding_to_content', 'comment_content', 'editing_id', 'editing_parent_id');
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
