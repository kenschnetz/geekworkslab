<?php

    namespace App\Http\Livewire;

    use App\Models\User as UserModel;
    use Livewire\Component;

    class Profile extends Component {
        public int $user_id;
        public UserModel $user;

        public function Mount() {
            $this->user = UserModel::find($this->user_id)->first();
        }

        public function Render() {
            return view('livewire.profile');
        }
    }
