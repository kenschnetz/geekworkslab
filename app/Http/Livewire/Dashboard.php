<?php

    namespace App\Http\Livewire;

    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Dashboard extends Component {

        public function Render() {
            $user = Auth::user();
            return view('livewire.dashboard')->with(['user' => $user]);
        }
    }
