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

        public $post_id;
        public $post;
        public Collection $content_types;
        public Collection $content_subtypes;
        public Collection $systems;
        public Collection $categories;
        public array $selected_images = [];
        public array $removed_images = [];
        public int $max_images_allowed = 4;
        public array $selected_tags = [];
        public array $removed_tags = [];
        public int $max_tags_allowed = 6;
        public array $selected_attributes = [];
        public array $removed_attributes = [];
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
            if (empty($this->post_id)) {
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
                $this->post->slug = '';
                $this->post->description = '';
                $this->post->content = '';
            } else {
                $this->post = PostModel::where('id', $this->post_id)->with('Category')->first();
                $selected_images = $this->post->Images()->get();
                foreach($selected_images as $selected_image) {
                    $this->selected_images[$selected_image->id] = $selected_image;
                }
                $selected_tags = $this->post->Tags()->get();
                foreach($selected_tags as $selected_tag) {
                    $this->selected_tags[$selected_tag->id] = $selected_tag;
                }
                $selected_attributes = $this->post->Attributes()->get();
                foreach($selected_attributes as $selected_attribute) {
                    $attribute = [
                        'id' => $selected_attribute->Attribute->id,
                        'name' => $selected_attribute->Attribute->name,
                        'description' => $selected_attribute->Attribute->description,
                        'value' => $selected_attribute->value,
                    ];
                    $this->selected_attributes[$attribute['id']] = $attribute;
                }
            }
        }

        public function ResetPagination($action) {
            match($action) {
                0 => $this->showImageManagementModal = true,
                1 => $this->showTagManagementModal = true,
                2 => $this->showAttributeManagementModal = true,
            };
            $this->resetPage();
        }

        public function SavePost() {
            if (!empty($this->post->id)) {
                foreach($this->removed_images as $removed_image) {
                    PostImageModel::where('post_id', $this->post->id)->where('image_id', $removed_image['id'])->delete();
                }
                foreach($this->removed_tags as $removed_tag) {
                    PostTagModel::where('post_id', $this->post->id)->where('tag_id', $removed_tag['id'])->delete();
                }
                foreach($this->removed_attributes as $removed_attribute) {
                    PostAttributeModel::where('post_id', $this->post->id)->where('attribute_id', $removed_attribute['id'])->delete();
                }
            }
            if (empty($this->post->slug)) {
                $this->post->slug = (new Misc)->GenerateUniqueSlug($this->post->title);
            }
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
            return redirect()->route( 'post', ['category_slug' => $this->post->Category->slug, 'post_slug' => $this->post->slug]);
        }

        public function ToggleImage($image) {
            $this->selected_images = $this->ToggleItem($image, $this->selected_images, $this->max_images_allowed, 0);
        }

        public function UploadImage() {
            $this->validate([
                'new_image.name' => 'required|string',
                'new_image.file' => 'required|image',
            ]);
            $path = $this->new_image['file']->store('/public/post-images/' . Auth::id());
            ImageModel::create([
                'user_id' => Auth::id(),
                'name' => $this->new_image['name'],
                'path' => Storage::url($path),
            ]);
            $this->reset('new_image');
        }

        public function ToggleTag($tag) {
            $this->selected_tags = $this->ToggleItem($tag, $this->selected_tags, $this->max_tags_allowed, 1);
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
            $this->selected_attributes = $this->ToggleItem($attribute, $this->selected_attributes, $this->max_attributes_allowed, 2);
        }

        public function CreateAttribute() {
            $this->validate([
                'new_attribute.name' => 'required|string',
                'new_attribute.description' => 'required|string',
            ]);
            AttributeModel::create([
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
                ->paginate($paginate_count,  ['*'], 'images');
            $tags = TagModel::where('name', 'like', "%{$this->search_term}%")
                ->orWhere('description', 'like', "%{$this->search_term}%")
                ->paginate($paginate_count,  ['*'], 'tags');
            $attributes = AttributeModel::where('name', 'like', "%{$this->search_term}%")
                ->orWhere('description', 'like', "%{$this->search_term}%")
                ->paginate($paginate_count,  ['*'], 'attributes');
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

        private function ToggleItem($item, $array, $max_allowed, $item_type) {
            if (empty($array[$item['id']])) {
                if (count($array) < $max_allowed) {
                    $array[$item['id']] = $item;
                    $this->RestoreItem($item, $item_type);
                }
            } else {
                unset($array[$item['id']]);
                $this->RemoveItem($item, $item_type);
            }
            return $array;
        }

        private function RemoveItem($item, $item_type) {
            switch($item_type) {
                case 0: $this->removed_images[$item['id']] = $item; break;
                case 1: $this->removed_tags[$item['id']] = $item; break;
                default: $this->removed_attributes[$item['id']] = $item;
            }
        }

        private function RestoreItem($item, $item_type) {
            switch($item_type) {
                case 0: unset($this->removed_images[$item['id']]); break;
                case 1: unset($this->removed_tags[$item['id']]); break;
                default: unset($this->removed_attributes[$item['id']]);
            }
        }
    }
