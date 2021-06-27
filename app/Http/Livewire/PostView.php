<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class PostView extends Component {
        public int|null $user_id;
        public PostModel $post;
        public string $default_image_url = '/storage/post-images/default-placeholder.png';

        public function Mount() {
            $this->user_id = Auth::id();
        }

        public function CommentDate($created_at) {
            $date = Carbon::parse($created_at);
            $value = '';
            $years = $date->diff(Carbon::now())->format('%y');
            if ($years > 0) {
                $value .= $years . 'y';
            }
            $months = $date->diff(Carbon::now())->format('%m');
            if ($months > 0) {
                $value .= ' ' . $months . 'm';
            }
            $days = $date->diff(Carbon::now())->format('%d');
            if ($days > 0) {
                $value .= ' ' . $days . 'd';
            }
            return empty($value) ? 'Today' : $value;
        }

        public function Render() {
            return view('livewire.post-view');
        }
    }
