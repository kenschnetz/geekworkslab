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
        public bool $showPasswordResetModal = false;
        public bool $showPasswordResetSuccessModal = false;
        public bool $isStaff = false;
        public $user_action;
        public $new_user = [
            'name' => null,
            'email' => null,
            'password' => null,
            'generated_password' => null,
            'role_id' => 3,
        ];
        public $password_reset = [
            'email' => null,
            'password' => null
        ];

        public function Mount() {
            $this->isStaff = Auth::user()->role_id === 1;
        }

        public function ToggleInviteModal() {
            $this->user_action = 0;
            $this->showInviteModal = !$this->showInviteModal;
        }

        public function ToggleInviteSuccessModal() {
            $this->showInviteSuccessModal = !$this->showInviteSuccessModal;
        }

        public function TogglePasswordResetModal() {
            $this->user_action = 1;
            $this->showPasswordResetModal = !$this->showPasswordResetModal;
        }

        public function TogglePasswordResetSuccessModal() {
            $this->showPasswordResetSuccessModal = !$this->showPasswordResetSuccessModal;
        }

        public function GeneratePassword($new_user = true) {
            if ($new_user) {
                $this->new_user['generated_password'] = Str::random(6);
            } else {
                $this->password_reset['password'] = Str::random(6);
            }
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

        public function ResetUserPassword() {
            $password_reset_user = UserModel::where('email', $this->password_reset['email'])->first();
            if(!empty($password_reset_user)) {
                $this->validate();
                $password_reset_user->password = bcrypt($this->password_reset['password']);
                $password_reset_user->save();
                $this->showPasswordResetModal = false;
                $this->showPasswordResetSuccessModal = true;
            }
        }

        public function Render() {
            $user = Auth::user();
            return view('livewire.dashboard')->with(['user' => $user]);
        }

        protected function Rules() {
            if ($this->user_action === 0) {
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
            } else {
                return [
                    'password_reset.email' => 'required|string',
                    'password_reset.password' => 'required|string',
                ];
            }
        }
    }
