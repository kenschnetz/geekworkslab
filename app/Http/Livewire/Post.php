<?php

    namespace App\Http\Livewire;

    use Livewire\Component;
    use App\Models\Post as PostModel;

    class Post extends Component {
        public $name;
        public $post_id;
        public $post;
        public $delete = false;
        public $required_message = 'This field is required!';

        public function Mount() {
            if (empty($this->post_id)) {
                $this->post = [
//                    'team_id' => auth()->user()->current_team_id,
//                    'name' => null,
//                    'description' => null,
                ];
            } else {
                $this->post = PostModel::find($this->post_id)->first();
                $this->name = $this->post['name'];
            }
        }

        public function Render() {
            return view('livewire.post');
        }
    }
