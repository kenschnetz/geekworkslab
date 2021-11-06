<?php

    namespace App\Http\Livewire;

    use App\Models\User as UserModel;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
    use Illuminate\Validation\Rule;
    use Livewire\Component;

    class Dashboard extends Component {
        public bool $showInviteModal = false;
        public bool $showInviteSuccessModal = false;
        public bool $isAdmin = false;
        public $new_user = [
            'name' => null,
            'email' => null,
            'password' => null,
            'generated_password' => null,
            'role_id' => 3,
        ];

        public function Mount() {
            $this->isAdmin = Auth::user()->role_id === 1;
        }

        public function ToggleInviteModal() {
            $this->showInviteModal = !$this->showInviteModal;
        }

        public function ToggleInviteSuccessModal() {
            $this->showInviteSuccessModal = !$this->showInviteSuccessModal;
        }

        public function GeneratePassword() {
            $this->new_user['generated_password'] = Str::random(6);
        }

        public function AddUser() {
            $this->validate();
            $new_user_model = new UserModel();
            $new_user_model->name = $this->new_user['name'];
            $new_user_model->email = $this->new_user['email'];
            $new_user_model->password = bcrypt($this->new_user['generated_password']);
            $new_user_model->role_id = $this->new_user['role_id'];
            $new_user_model->save();
            $this->showInviteModal = false;
            if (!empty($new_user_model->id)) {
                $this->showInviteSuccessModal = true;
            }
        }

        public function Render() {
            $user = Auth::user();
            return view('livewire.dashboard')->with(['user' => $user]);
        }

        protected function Rules() {
            return [
                'new_user.name' => 'required|string',
                'new_user.email' => [
                    'required',
                    'string',
                    Rule::unique('users', 'email')
                ],
                'new_user.generated_password' => 'required|string',
                'new_user.role_id' => 'required|integer',
            ];
        }
    }
