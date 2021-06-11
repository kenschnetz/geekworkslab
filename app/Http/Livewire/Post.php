<?php

    namespace App\Http\Livewire;

    use Livewire\Component;
    use App\Models\Post as PostModel;

    class Post extends Component {
        public $name;
        public $post_id;
        public $post;
        public $comments;
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
                $this->post = PostModel::where('id', $this->post_id)->with('User', 'PostCategories', 'PostTags')->first();
                $this->post->meta = $this->post->PostMetas()->with('PostFields')->orderBy('version', 'desc')->first();
                $this->post->upvotes = $this->post->PostVotes()->where('vote', true)->count();
                $this->post->downvotes = $this->post->PostVotes()->where('vote', false)->count();
                $this->name = $this->post->meta->name;
                $this->post->comments = $this->post->PostComments();
            }
        }

        public function Render() {
            return view('livewire.post');
        }
    }
