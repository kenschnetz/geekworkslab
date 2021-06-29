<?php

    namespace App\Http\Livewire;

    use App\Models\User as UserModel;
    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Livewire\WithPagination;

    class Profile extends Component {
        use WithPagination;

        public int|null $user_id;
        public string $default_image_url = '/storage/post-images/default-placeholder.png';

        public function ShortenBigNumber($number) {
            return (new MiscUtilities)->ShortenBigNumber($number);
        }

        public function View($category_slug, $post_slug) {
            return redirect()->route( 'post', ['category_slug' => $category_slug, 'post_slug' => $post_slug]);
        }

        public function Mount() {
            if (empty($this->user_id)) {
                if (Auth::check()) {
                    $this->user_id = Auth::id();
                } else {
                    abort('404');
                }
            }
        }

        public function Render() {
            $user = UserModel::where('id', $this->user_id)
                ->withCount('Posts', 'Comments', 'PostUpvotes', 'CommentUpvotes', 'EarnedBadges')
                ->first();
            $posts = $user->Posts()->latest()->paginate(5);
            return view('livewire.profile')->with(['user' => $user, 'posts' => $posts]);
        }
    }
