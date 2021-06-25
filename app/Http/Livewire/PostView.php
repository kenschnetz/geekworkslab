<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use Livewire\Component;

    class PostView extends Component {
        public PostModel $post;
        public string $default_image_url = '/storage/post-images/default-placeholder.png';

        public function Render() {
            return view('livewire.post-view');
        }
    }
