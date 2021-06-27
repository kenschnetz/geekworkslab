<?php

    namespace App\Http\Livewire;

    use App\Models\User as UserModel;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Profile extends Component {
        public int|null $user_id;
        public UserModel $user;

        public function Mount() {
            $user_id = empty($this->user_id) ? Auth::id() : $this->user_id;
            if (empty($user_id)) {
                abort('404');
            } else {
                $this->user = UserModel::where('id', $user_id)->first();
            }
        }

        public function Render() {
            return view('livewire.profile');
        }
    }
