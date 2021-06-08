<?php

    namespace App\Http\Livewire;

    use App\Models\Post as PostModel;
    use Livewire\Component;

    class Home extends Component {
        public function Render() {
            return view('livewire.home', ['posts' => $this->GetPosts()]);
        }

        private function GetPosts() {
            return PostModel::all();
        }

        public function View($id) {
            return redirect()->to('post/' . $id);
        }
    }
