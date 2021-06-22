<?php

    namespace App\Http\Livewire;

    use App\Models\PostComment as PostCommentModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use App\Models\Post as PostModel;
    use Route;

    class Post extends Component {
        public int|null|string $user_id;
        public int $post_id;
        public string $comment_content = "";
        public string $reply_content = "";
        public string $edit_content = "";
        public int $edit_comment_id = 0;
        public bool $confirming_delete = false;
        public int $delete_comment_id = 0;

        public function SubmitComment(int $comment_id = null, int $action = 0) {
            if ($action === 2) {
                PostCommentModel::where('id', $this->edit_comment_id)->update(['content' => $this->edit_content]);
            } else {
                PostCommentModel::create([
                    'user_id' => $this->user_id,
                    'post_id' => $this->post_id,
                    'post_comment_id' => $comment_id,
                    'content' => $action === 0 ? $this->comment_content : $this->reply_content
                ]);
                if ($action === 0) {
                    return redirect('post/' . $this->post_id . '/#comments');
                }
            }
            $this->comment_content = "";
            $this->reply_content = "";
            $this->edit_content = "";
        }

        public function Replying() {
            $this->reply_content = "";
        }

        public function EditComment($current_content, $comment_id) {
            $this->edit_content = $current_content;
            $this->edit_comment_id = $comment_id;
        }

        public function DeleteComment($id) {
            $this->confirming_delete = true;
            $this->delete_comment_id = $id;
        }

        public function CancelDeleteModal() {
            $this->confirming_delete = false;
        }

        public function Delete() {
            PostCommentModel::where('id', $this->delete_comment_id)->delete();
            $this->confirming_delete = false;
            return redirect()->route('post', ['post_id' => $this->post_id]);
        }

        public function GetPost() {
            $post = PostModel::where('id', $this->post_id)->with('User', 'PostCategories', 'PostTags')->first();
            $post->meta = $post->PostMetas()->with('PostFields')->orderBy('version', 'desc')->first();
            $post->comments = $post->PostComments()->get();
            return $post;
        }

        public function Mount() {
            $this->user_id = Auth::id();
        }

        public function Render() {
            return view('livewire.post', ['post' => $this->GetPost()]);
        }
    }
