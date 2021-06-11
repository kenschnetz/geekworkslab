<?php

    namespace App\Http\Livewire;

    use Livewire\Component;

    class PostComment extends Component {
        public $post_comment;

        public function Mount() {
            $this->post_comment->post_comments = $this->post_comment->PostComments();
        }

        public function Render() {
            return view('livewire.post-comment');
        }
    }
