<?php

    namespace App\Http\Livewire;

    use App\Models\Category as CategoryModel;
    use App\Models\Post as PostModel;
    use Livewire\Component;

    class PostList extends Component {
        public CategoryModel $category;
        public string $default_image_url = '/storage/post-images/default-placeholder.png';

        public function View($category_slug, $post_slug) {
            return redirect()->route( 'post', ['category_slug' => $category_slug, 'post_slug' => $post_slug]);
        }

        public function FormatStat($number) {
            if ($number < 1000) {
                return number_format($number);
            } else if ($number < 1000000) {
                return number_format($number / 1000, 1) . 'k';
            } else if ($number < 1000000000) {
                return number_format($number / 1000000, 1) . 'm';
            } else if ($number < 1000000000000) {
                return number_format($number / 1000000000, 1) . 'b';
            } else {
                return number_format($number);
            }
        }

        public function Render() {
            $posts = empty($this->category)
                ? PostModel::where('type', '!=', 2)
                    ->where('published', true)
                    ->where('moderated', false)
                    ->with('Images')
                    ->withCount('Upvotes', 'AllComments')
                    ->get()
                : $this->category
                    ->Posts()
                    ->where('type', '!=', 2)
                    ->where('published', true)
                    ->where('moderated', false)
                    ->with('Images')
                    ->withCount('Upvotes', 'AllComments')
                    ->get();
            return view('livewire.post-list', ['posts' => $posts]);
        }
    }
