<?php

    namespace App\Http\Livewire;

    use App\Models\Attribute as AttributeModel;
    use App\Models\Category as CategoryModel;
    use App\Models\ContentType as ContentTypeModel;
    use App\Models\ContentSubtype as ContentSubtypeModel;
    use App\Models\Image as ImageModel;
    use App\Models\Post as PostModel;
    use App\Models\PostAttribute as PostAttributeModel;
    use App\Models\PostImage as PostImageModel;
    use App\Models\PostTag as PostTagModel;
    use App\Models\System as SystemModel;
    use App\Models\Tag as TagModel;
    use App\Utilities\Misc;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Livewire\Component;
    use Livewire\WithFileUploads;
    use Livewire\WithPagination;

    class PostEdit extends Component {
        use WithPagination;
        use WithFileUploads;

        public int|null $post_id;
        public $post;
        public Collection $content_types;
        public Collection $content_subtypes;
        public Collection $systems;
        public Collection $categories;
        public array $selected_images = [];
        public int $max_images_allowed = 4;
        public array $selected_tags = [];
        public int $max_tags_allowed = 6;
        public array $selected_attributes = [];
        public int $max_attributes_allowed = 12;
        public bool $showImageManagementModal = false;
        public bool $showTagManagementModal = false;
        public bool $showAttributeManagementModal = false;
        public string $search_term = '';
        public $new_image = [
            'name' => '',
            'file' => null
        ];
        public $new_tag = [
            'name' => '',
            'description' => ''
        ];
        public $new_attribute = [
            'name' => '',
            'description' => ''
        ];

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
                $this->post->published = true;
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
            foreach($this->selected_images as $selected_image) {
                PostImageModel::updateOrCreate(
                    ['post_id' => $this->post->id, 'image_id' => $selected_image['id']],
                    ['post_id' => $this->post->id, 'image_id' => $selected_image['id']]
                );
            }
            foreach($this->selected_tags as $selected_tag) {
                PostTagModel::updateOrCreate(
                    ['post_id' => $this->post->id, 'tag_id' => $selected_tag['id']],
                    ['post_id' => $this->post->id, 'tag_id' => $selected_tag['id']]
                );
            }
            foreach($this->selected_attributes as $selected_attribute) {
                PostAttributeModel::updateOrCreate(
                    ['post_id' => $this->post->id, 'attribute_id' => $selected_attribute['id']],
                    ['post_id' => $this->post->id, 'attribute_id' => $selected_attribute['id'], 'value' => $selected_attribute['value']]
                );
            }
        }

        public function ToggleImage($image) {
            $this->selected_images = $this->ToggleItem($image, $this->selected_images, $this->max_images_allowed);
        }

        public function UploadImage() {
            $this->validate([
                'new_image.name' => 'required|string',
                'new_image.file' => 'required|image',
            ]);
            $path = $this->new_image['file']->store('/public/post-images');
            ImageModel::create([
                'user_id' => Auth::id(),
                'name' => $this->new_image['name'],
                'path' => Storage::url($path),
            ]);
            $this->reset('new_image');
        }

        public function ToggleTag($tag) {
            $this->selected_tags = $this->ToggleItem($tag, $this->selected_tags, $this->max_tags_allowed);
        }

        public function CreateTag() {
            $this->validate([
                'new_tag.name' => 'required|string|unique:tags,name',
                'new_tag.description' => 'required|string',
            ]);
            TagModel::create([
                'name' => $this->new_tag['name'],
                'description' => $this->new_tag['description'],
            ]);
            $this->reset('new_tag');
        }

        public function ToggleAttribute($attribute) {
            $this->selected_attributes = $this->ToggleItem($attribute, $this->selected_attributes, $this->max_attributes_allowed);
        }

        public function CreateAttribute() {
            $this->validate([
                'new_attribute.name' => 'required|string',
                'new_attribute.description' => 'required|string',
            ]);
            TagModel::create([
                'name' => $this->new_attribute['name'],
                'description' => $this->new_attribute['description'],
            ]);
            $this->reset('new_attribute');
        }

        public function CloseModal() {
            $this->reset('showImageManagementModal', 'showTagManagementModal', 'showAttributeManagementModal', 'search_term');
        }

        public function Render() {
            $paginate_count = 16;
            $images = Auth::user()
                ->Images()
                ->where('name', 'like', "%{$this->search_term}%")
                ->orWhere('path', 'like', "%{$this->search_term}%")
                ->paginate($paginate_count);
            $tags = TagModel::where('name', 'like', "%{$this->search_term}%")
                ->orWhere('description', 'like', "%{$this->search_term}%")
                ->paginate($paginate_count);
            $attributes = AttributeModel::where('name', 'like', "%{$this->search_term}%")
                ->orWhere('description', 'like', "%{$this->search_term}%")
                ->paginate($paginate_count);
            foreach($attributes as $attribute) {
                $attribute['value'] = '';
            }
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
                'post.published' => 'required|bool',
                'post.title' => 'required|string',
                'post.slug' => 'required|string',
                'post.description' => 'nullable|string',
                'post.content' => 'nullable|string',
            ];
        }

        private function ToggleItem($item, $array, $max_allowed) {
            if (empty($array[$item['id']])) {
                if (count($array) < $max_allowed) {
                    $array[$item['id']] = $item;
                }
            } else {
                unset($array[$item['id']]);
            }
            return $array;
        }
    }
