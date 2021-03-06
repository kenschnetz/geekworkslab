<?php

    namespace App\Http\Livewire;

    use App\Models\Category as CategoryModel;
    use App\Models\Post as PostModel;
    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Livewire\WithPagination;

    class PostList extends Component {
        use WithPagination;

        public bool $user_posts_only = false;
        public int|null $user_id;
        public CategoryModel $category;
        public string $default_image_url = '/img/default-placeholder.png';
        public string $search_term = '';

        public function ShortenBigNumber($number) {
            return (new MiscUtilities)->ShortenBigNumber($number);
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
            $pagination_count = 20;
            $posts = $this->user_posts_only
                ? PostModel::where('user_id', $this->user_id)
                    ->where('content_type_id', '!=', 3)
                    ->where('content_subtype_id', '!=', 4)
                    ->where('published', true)
                    ->where(function($query) {
                        $query->where('title', 'like', "%{$this->search_term}%")
                            ->orWhere('description', 'like', "%{$this->search_term}%")
                            ->orWhere('content', 'like', "%{$this->search_term}%");
                    })->with('Images')
                    ->withCount('Upvotes', 'AllComments')
                    ->latest()
                    ->paginate($pagination_count)
                : (empty($this->category)
                    ? PostModel::where('content_type_id', '!=', 3)
                        ->where('content_subtype_id', '!=', 4)
                        ->where('published', true)
                        ->when(optional(Auth::user())->role_id !== 1, function($query) {
                            return $query->where('moderated', false);
                        })->where(function($query) {
                            $query->where('title', 'like', "%{$this->search_term}%")
                                ->orWhere('description', 'like', "%{$this->search_term}%")
                                ->orWhere('content', 'like', "%{$this->search_term}%");
                        })->with('Images')
                        ->withCount('Upvotes', 'AllComments')
                        ->latest()
                        ->paginate($pagination_count)
                    : $this->category->Posts()
                        ->where('content_type_id', '!=', 3)
                        ->where('content_subtype_id', '!=', 4)
                        ->where('published', true)
                        ->where('moderated', false)
                        ->where(function($query) {
                            $query->where('title', 'like', "%{$this->search_term}%")
                                ->orWhere('description', 'like', "%{$this->search_term}%")
                                ->orWhere('content', 'like', "%{$this->search_term}%");
                        })->with('Images')
                        ->withCount('Upvotes', 'AllComments')
                        ->latest()
                        ->paginate($pagination_count));
            return view('livewire.post-list')->with(['posts' => $posts]);
        }
    }
