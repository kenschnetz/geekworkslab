<?php

    namespace App\Http\Livewire;

    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class PostComment extends Component {
        public $user_id;
        public $post;
        public $comment;
        protected $listeners = ['CommentsUpdated' => '$refresh'];

        public function Mount($user_id, $post, $comment) {
            $this->user_id = $user_id;
            $this->post = $post;
            $this->comment = $comment;
        }

        public function ReplyingTo($id, $name, $content) {
            $this->emit('ReplyingTo', $id, $name, $content);
        }

        public function EditComment($id, $content, $post_comment_id = null) {
            $this->emit('EditComment', $id, $post_comment_id, $content);
        }

        public function DeleteComment($id) {
            $this->emit('DeleteComment', $id);
        }

        public function CommentDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function Render() {
            return view('livewire.post-comment');
        }
    }
