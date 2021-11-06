<?php

    namespace App\Http\Livewire;

    use Livewire\Component;

    class Terms extends Component {
        public $terms_file = '/storage/docs/terms.pdf';

        public function Render() {
            return view('livewire.terms');
        }
    }
