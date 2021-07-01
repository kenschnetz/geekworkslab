<div x-data="{ showImageManagementModal: @entangle('showImageManagementModal'),showTagManagementModal: @entangle('showTagManagementModal'), showAttributeManagementModal: @entangle('showAttributeManagementModal'), }">
    <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <form id="post-form" wire:submit.prevent="SavePost">
            @csrf
            <div class="mt-4 w-full">
                <select class="form-control mt-1 w-full" name="type" wire:model="post.content_type_id">
                    <option value="null">Select Post Type</option>
                    @foreach ($content_types as $content_type)
                        <option value="{{ $content_type->id }}">
                            {{ $content_type->name }}
                        </option>
                    @endforeach
                </select>
                @error('post.content_type_id') <span class="text-red-500">Content Type is required</span> @enderror
            </div>
            @if($post->content_type_id == 2)
                <div class="mt-4 w-full">
                    <div class="relative inline-block mr-4 align-middle select-none transition duration-200 ease-in">
                        <input wire:model="post.locked" type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <div class="relative inline-block ml-4">
                        @if($post->locked)
                            Post locked - CANNOT be cloned by other authors for use in standard posts
                        @else
                            Post unlocked - CAN be cloned by other authors for use in standard posts
                        @endif
                    </div>
                </div>
            @endif
            <div class="mt-4 w-full">
                <select class="form-control mt-1 w-full" name="system" wire:model="post.system_id">
                    <option value="null">Select System</option>
                    @foreach ($systems as $system)
                        <option value="{{ $system->id }}">
                            {{ $system->name }}
                        </option>
                    @endforeach
                </select>
                @error('post.system_id') <span class="text-red-500">System is required</span> @enderror
            </div>
            <div class="mt-4 w-full">
                <select class="form-control mt-1 w-full" name="category" wire:model="post.category_id">
                    <option value="null">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('post.category_id') <span class="text-red-500">Category is required</span> @enderror
            </div>
            <hr class="my-3" />
            <div>
                <div class="font-bold text-lg">
                    Images
                </div>
                @if(count($selected_images) > 0)
                    <div class="font-md my-3 grid w-full sm:grid-cols-2 md:grid-cols-4 gap-1">
                        @foreach($selected_images as $selected_image)
                            <div>
                                <div style="background-image: url({{$selected_image['path']}});" class="image-management-square object-cover cursor-pointer border"></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="italic my-3">
                        No Images selected
                    </p>
                @endif
                <a x-on:click="showImageManagementModal = true" class="w-full md:w-1/4 text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Images
                </a>
            </div>
            <hr class="my-3" />
            <div>
                <div class="font-bold text-lg">
                    Tags
                </div>
                @if(count($selected_tags) > 0)
                    <div class="font-md my-3 grid md:grid-cols-4 gap-1">
                        @foreach($selected_tags as $selected_tag)
                            <div class="font-bold p-3 border text-center">
                                {{$selected_tag['name']}}
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="italic my-3">
                        No Tags selected
                    </p>
                @endif
                <a x-on:click="showTagManagementModal = true" class="w-full md:w-1/4 text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Tags
                </a>
            </div>
            <hr class="my-3" />
            <div>
                <div class="font-bold text-lg">
                    Attributes
                </div>
                @if(count($selected_attributes) > 0)
                    <div class="font-md my-3 grid lg:grid-cols-2 gap-1">
                        @foreach($selected_attributes as $index => $selected_attribute)
                            <div class="p-3 border text-center" wire:key="selected-attribute-{{$selected_attribute['id']}}">
                                <div class="font-bold my-1">{{$selected_attribute['name']}}</div>
                                <input class="w-full" type="text" wire:model.lazy="selected_attributes.{{$index}}.value" placeholder="{{$selected_attribute['name']}} value"/>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="italic my-3">
                        No Attributes selected
                    </p>
                @endif
                <a x-on:click="showAttributeManagementModal = true" class="w-full md:w-1/4 text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Attributes
                </a>
            </div>
            <hr class="my-3" />
            <div class="mt-4 w-full">
                <label class="font-bold text-lg">Title
                    <input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="post.title" placeholder="Title">
                </label>
                @error('post.title') <span class="text-red-500">{{$message}}</span> @enderror
            </div>
            <div class="mt-4 w-full">
                <label class="font-bold text-lg">Description
                    <input id="description" class="block mt-1 w-full" type="text" name="description" wire:model="post.description" placeholder="Description">
                </label>
                @error('post.description') <span class="text-red-500">{{$message}}</span> @enderror
            </div>
            <div class="mt-4 w-full" wire:ignore>
{{--                <textarea id="content" class="block mt-1 w-full" type="text" name="content" wire:model="post.content" placeholder="Content"></textarea>--}}
                <label class="font-bold text-lg">Content</label>
                <hr class="mt-1 mb-2" />
                <trix-editor x-data x-on:trix-change="$dispatch('input', event.target.value)" wire:model.debounce.1000ms="post.content" wire:key="post-rich-editor"></trix-editor>
                @error('post.content') <span class="text-red-500">{{$message}}</span> @enderror
            </div>
            <hr class="mt-4"/>
            <div class="flex items-rightr mt-4">
                <button type="submit" class="inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    {{ empty($post_id) ? 'Create' : 'Update' }} Post
                </button>
            </div>
        </form>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showImageManagementModal">
            <p class="text-xl font-bold">Manage Images</p>
            <hr class="my-3" />
            <div x-data="{ tab: 0 }" id="images-tab-wrapper" x-cloak>
                <nav>
                    <a :class="{ 'bg-white border border-b-0': tab === 0 }" class="inline-block p-4" @click.prevent="tab = 0" href="#">Available Images</a>
                    <a :class="{ 'bg-white border border-b-0': tab === 1 }" class="inline-block p-4" @click.prevent="tab = 1" href="#">Upload Image</a>
                </nav>
                <div x-show="tab === 0" class="p-3 border -mt-px">
                    <div class="flex items-center">
                        <input wire:model="search_term" class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="image-search" type="text" placeholder="Filter" wire:model.lazy="search_term">
                    </div>
                    <hr class="my-3" />
                    <div class="grid grid-cols-2 md:grid-cols-4">
                        @foreach($images as $image)
                            <div wire:click="ToggleImage({{$image}})" style="background-image: url({{$image->path}});" class="image-management-square object-cover cursor-pointer {{ empty($selected_images[$image->id]) ? 'border' : 'border-2 border-indigo-800' }}"></div>
                        @endforeach
                    </div>
                    @if ($images->hasPages())
                        <hr class="my-3" />
                    @endif
                    {{ $images->links() }}
                </div>
                <div x-show="tab === 1" class="p-3 border -mt-px">
                    <form class="w-full" id="new-image-form" wire:submit.prevent="UploadImage()">
                        @csrf
                        <div class="w-full p-3">
                            <input class="appearance-none bg-transparent w-full text-gray-700 p-2 border-0 leading-tight focus:outline-none" type="text" wire:model="new_image.name" placeholder="Image Name">
                            @error('new_image.name')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                            <hr class="my-3" />
                            <input class="appearance-none bg-transparent border-gray-200 w-full text-gray-700 mr-3 p-2 leading-tight focus:outline-none" type="file" wire:model="new_image.file">
                            @error('new_image.file')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                            <hr class="my-3" />
                            <button class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800" type="submit">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="my-3">
                <span class="italic">Images selected: {{count($selected_images)}} of {{$max_images_allowed}}</span>
                <a wire:click="CloseModal()" class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Done
                </a>
            </div>
        </x-modal>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showTagManagementModal">
            <p class="text-xl font-bold">Manage Tags</p>
            <hr class="my-3" />
            <div x-data="{ tab: 0 }" id="tags-tab-wrapper" x-cloak>
                <nav>
                    <a :class="{ 'bg-white border border-b-0': tab === 0 }" class="inline-block p-4" @click.prevent="tab = 0" href="#">Available Tags</a>
                    <a :class="{ 'bg-white border border-b-0': tab === 1 }" class="inline-block p-4" @click.prevent="tab = 1" href="#">Create Tag</a>
                </nav>
                <div x-show="tab === 0" class="p-3 border -mt-px">
                    <div class="flex items-center">
                        <input wire:model="search_term" class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="tag-search" type="text" placeholder="Filter" wire:model.lazy="search_term">
                    </div>
                    <hr class="my-3" />
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
                        @foreach($tags as $tag)
                            <div wire:click="ToggleTag({{$tag}})" class="cursor-pointer p-3 text-center font-bold {{ empty($selected_tags[$tag->id]) ? 'border' : 'border-2 border-indigo-800' }}">
                                {{ $tag->name }}
                            </div>
                        @endforeach
                    </div>
                    @if ($tags->hasPages())
                        <hr class="my-3" />
                    @endif
                    {{ $tags->links() }}
                </div>
                <div x-show="tab === 1" class="p-3 border -mt-px">
                    <form class="w-full" id="new-tag-form" wire:submit.prevent="CreateTag()">
                        @csrf
                        <div class="w-full p-3">
                            <input class="appearance-none bg-transparent w-full text-gray-700 p-2 border-0 leading-tight focus:outline-none" type="text" wire:model="new_tag.name" placeholder="Name">
                            @error('new_tag.name')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                            <hr class="my-3" />
                            <input class="appearance-none bg-transparent w-full text-gray-700 p-2 border-0 leading-tight focus:outline-none" type="text" wire:model="new_tag.description" placeholder="Description">
                            @error('new_tag.description')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                            <hr class="my-3" />
                            <button class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800" type="submit">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="my-3">
                <span class="italic">Tags selected: {{count($selected_tags)}} of {{$max_tags_allowed}}</span>
                <a wire:click="CloseModal()" class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Done
                </a>
            </div>
        </x-modal>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showAttributeManagementModal">
            <p class="text-xl font-bold">Manage Attributes</p>
            <hr class="my-3" />
            <div x-data="{ tab: 0 }" id="tags-tab-wrapper" x-cloak>
                <nav>
                    <a :class="{ 'bg-white border border-b-0': tab === 0 }" class="inline-block p-4" @click.prevent="tab = 0" href="#">Available Attributes</a>
                    <a :class="{ 'bg-white border border-b-0': tab === 1 }" class="inline-block p-4" @click.prevent="tab = 1" href="#">Create Attribute</a>
                </nav>
                <div x-show="tab === 0" class="p-3 border -mt-px">
                    <div class="flex items-center">
                        <input wire:model="search_term" class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="attribute-search" type="text" placeholder="Filter" wire:model.lazy="search_term">
                    </div>
                    <hr class="my-3" />
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
                        @foreach($attributes as $attribute)
                            <div wire:click="ToggleAttribute({{$attribute}})" class="cursor-pointer p-3 text-center font-bold {{ empty($selected_attributes[$attribute->id]) ? 'border' : 'border-2 border-indigo-800' }}">
                                {{ $attribute->name }}
                            </div>
                        @endforeach
                    </div>
                    @if ($attributes->hasPages())
                        <hr class="my-3" />
                    @endif
                    {{ $attributes->links() }}
                </div>
                <div x-show="tab === 1" class="p-3 border -mt-px">
                    <form class="w-full" id="new-attribute-form" wire:submit.prevent="CreateAttribute()">
                        @csrf
                        <div class="w-full p-3">
                            <input class="appearance-none bg-transparent w-full text-gray-700 p-2 border-0 leading-tight focus:outline-none" type="text" wire:model="new_attribute.name" placeholder="Name">
                            @error('new_attribute.name')<p class="my-3 italic text-red-700">Tag name is required</p>@enderror
                            <hr class="my-3" />
                            <input class="appearance-none bg-transparent w-full text-gray-700 p-2 border-0 leading-tight focus:outline-none" type="text" wire:model="new_attribute.description" placeholder="Description">
                            @error('new_attribute.description')<p class="my-3 italic text-red-700">Tag description is required</p>@enderror
                            <hr class="my-3" />
                            <button class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800" type="submit">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="my-3">
                <span class="italic">Attributes selected: {{count($selected_attributes)}} of {{$max_attributes_allowed}}</span>
                <a wire:click="CloseModal()" class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Done
                </a>
            </div>
        </x-modal>
    </div>
</div>
