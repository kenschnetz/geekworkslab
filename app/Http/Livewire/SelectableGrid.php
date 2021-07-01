<?php

    namespace App\Http\Livewire;

    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Livewire\WithPagination;

    class SelectableGrid extends Component {
        use WithPagination;

        public $showImageManagementModal = false;
        public array $selected_images = [];

        public function ToggleImage($id) {
            if (($key = array_search($id, $this->selected_images)) !==false) {
                array_splice($this->selected_images, $key, 1);
            } else {
                array_push($this->selected_images, $id);
            }
        }

        public function Render() {
            $images = Auth::user()->Images()->paginate(9);
            return view('livewire.selectable-grid')->with(['images' => $images]);
        }
    }
