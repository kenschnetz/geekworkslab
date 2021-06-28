<?php

    namespace App\Http\Livewire;

    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class PostComment extends Component {
        public $user_id;
        public $comment;
        protected $listeners = ['CommentsUpdated' => '$refresh'];

        public function Mount() {
            $this->user_id = Auth::id();
        }

        public function RespondingTo($id, $name, $content) {
            $this->emit('RespondingTo', $id, $name, $content);
        }

        public function EditComment($id, $content, $post_comment_id) {
            $this->emit('EditComment', $id, $content, $post_comment_id);
        }

        public function CommentDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function Render() {
            return view('livewire.post-comment');
        }
    }
