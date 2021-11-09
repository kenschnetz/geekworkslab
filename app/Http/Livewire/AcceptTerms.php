<?php

    namespace App\Http\Livewire;

    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class AcceptTerms extends Component {
        public $user;

        public function Mount() {
            $this->user = Auth::user();
        }

        public function AcceptTerms() {
            $this->validate();
            $this->user->terms_accepted_date = Carbon::now();
            $this->user->save();
            $this->redirect('dashboard');
        }

        public function Render() {
            return view('livewire.accept-terms');
        }

        protected function Rules() {
            return [
                'user.terms_accepted' => 'required|boolean:true',
            ];
        }
    }
