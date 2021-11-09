<?php

    namespace App\Http\Livewire;

    use App\Models\PublicMessage as PublicMessageModel;
    use App\Utilities\Misc as MiscUtilities;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Messenger extends Component {
        public $message;

        public function MessageDate($created_at) {
            return (new MiscUtilities)->ShortenDate($created_at);
        }

        public function SendMessage() {
            if (!empty($this->message)) {
                $new_message = new PublicMessageModel();
                $new_message->user_id = Auth::user()->id;
                $new_message->content = $this->message;
                $new_message->save();
                return redirect(request()->header('Referer'));
            }
        }

        public function DeleteMessage($id) {
            PublicMessageModel::where('id', $id)->delete();
            return redirect(request()->header('Referer'));
        }

        public function Render() {
            return view('livewire.messenger');
        }
    }
