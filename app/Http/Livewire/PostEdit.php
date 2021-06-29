<?php

    namespace App\Http\Livewire;

    use App\Models\Attribute as AttributeModel;
    use App\Models\Category as CategoryModel;
    use App\Models\ContentType as ContentTypeModel;
    use App\Models\ContentSubtype as ContentSubtypeModel;
    use App\Models\Image;
    use App\Models\Post as PostModel;
    use App\Models\PostImage as PostImageModel;
    use App\Models\PostTag as PostTageModel;
    use App\Models\PostAttribute as PostAttributeModel;
    use App\Models\System as SystemModel;
    use App\Models\Tag as TagModel;
    use App\Models\User as UserModel;
    use App\Utilities\Misc;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Livewire\WithPagination;

    class PostEdit extends Component {
        use WithPagination;

        public int|null $post_id;
        public $post;
        public Collection $content_types;
        public Collection $content_subtypes;
        public Collection $systems;
        public Collection $categories;
//        public Collection $images;
        public array $selected_images = [];
//        public Collection $tags;
        public array $selected_tags = [];
//        public Collection $attributes;
        public array $selected_attributes = [];
        public bool $showImageManagementModal = false;
        public bool $showTagManagementModal = false;
        public bool $showAttributeManagementModal = false;

        public function Mount() {
            $this->content_types = ContentTypeModel::all();
            $this->content_subtypes = ContentSubtypeModel::all();
            $this->systems = SystemModel::all();
            $this->categories = CategoryModel::all();
            if (empty($post_id)) {
                $this->post = new PostModel;
                $this->post->user_id = Auth::id();
                $this->post->content_type_id = null;
                $this->post->content_subtype_id = 1;
                $this->post->system_id = null;
                $this->post->category_id = null;
                $this->post->locked = true;
                $this->post->title = '';
                $this->post->slug = '';
                $this->post->description = '';
                $this->post->content = '';
            } else {
                $this->post = PostModel::where('id', $this->post_id)->first();
                $this->selected_images = $this->post->PostImages();
                $this->selected_tags = $this->post->PostTags();
                $this->selected_attributes = $this->post->PostAttributes();
            }
        }

        public function SavePost() {
            $this->post->slug = (new Misc)->GenerateUniqueSlug($this->post->title);
            $this->validate();
            $this->post->save();
        }

        public function Render() {
            $images = Auth::user()->Images()->paginate(2);
            $tags = TagModel::paginate(2);
            $attributes = AttributeModel::paginate(2);
            return view('livewire.post-edit')->with(['images' => $images, 'tags' => $tags, 'attributes' => $attributes]);
        }

        protected function Rules() {
            return [
                'post.user_id' => 'required|integer',
                'post.content_type_id' => 'required|integer',
                'post.content_subtype_id' => 'required|integer',
                'post.system_id' => 'required|integer',
                'post.category_id' => 'required|integer',
                'post.locked' => 'required|bool',
                'post.title' => 'required|string',
                'post.slug' => 'required|string',
                'post.description' => 'nullable|string',
                'post.content' => 'nullable|string',
            ];
        }
    }
