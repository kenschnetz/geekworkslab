<div x-data="{ showImageManagementModal: @entangle('showImageManagementModal'),showTagManagementModal: @entangle('showTagManagementModal'),showAttributeManagementModal: @entangle('showAttributeManagementModal'), }">
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
{{--            @if(!empty($post->content_type_id) && $post->content_type_id != 3)--}}
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
                <p class="italic font-md my-3">
                    @if(count($selected_images) > 0)
                        @foreach($selected_images as $selected_image)
                            {{$selected_image->name . $loop->last() ? '' : ', ' }}
                        @endforeach
                    @else
                        No Images selected
                    @endif
                </p>
                <a x-on:click="showImageManagementModal = true" class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Images
                </a>
                <hr class="my-3" />
                <p class="italic font-md my-3">
                    @if(count($selected_tags) > 0)
                        @foreach($selected_tags as $selected_tag)
                            {{$selected_tag->name . $loop->last() ? '' : ', ' }}
                        @endforeach
                    @else
                        No Tags selected
                    @endif
                </p>
                <a x-on:click="showTagManagementModal = true" class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Tags
                </a>
                <hr class="my-3" />
                <p class="italic font-md my-3">
                    @if(count($selected_attributes) > 0)
                        @foreach($selected_attributes as $selected_attribute)
                            {{$selected_attribute->name . $loop->last() ? '' : ', ' }}
                        @endforeach
                    @else
                        No Attributes selected
                    @endif
                </p>
                <a x-on:click="showAttributeManagementModal = true" class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Manage Attributes
                </a>
                <hr class="my-3" />
{{--            @endif--}}
            <div class="mt-4 w-full">
                <input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="post.title" placeholder="Title">
                @error('post.title') <span class="text-red-500">This field is required!</span> @enderror
            </div>
            <div class="mt-4 w-full">
                <input id="description" class="block mt-1 w-full" type="text" name="description" wire:model="post.description" placeholder="Description">
                @error('post.description') <span class="text-red-500">This field is required!</span> @enderror
            </div>
            <div class="mt-4 w-full">
                <textarea id="content" class="block mt-1 w-full" type="text" name="content" wire:model="post.content" placeholder="Content"></textarea>
                @error('post.content') <span class="text-red-500">This field is required!</span> @enderror
            </div>
            @error('post.user_id') <span class="text-red-500">Valid slug is required!</span> @enderror
            @error('post.slug') <span class="text-red-500">Valid slug is required!</span> @enderror
            <hr class="mt-4"/>
            <div class="flex items-rightr mt-4">
                <button type="submit" class="inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                    Create Post
                </button>
            </div>
        </form>
        <div>
            {{$post}}
        </div>
        <div>
            {{json_encode($selected_images)}}
        </div>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-1/2 h-1/2" trigger="showImageManagementModal">
            <p class="text-xl font-bold">Manage Images</p>
            <hr class="my-3" />
            <div class="flex items-center">
                <input class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Filter" wire:model.lazy="search_term">
                <div class="-ml-16">
                    <button class="text-gray-500 rounded-full px-6 py-2 focus:outline-none h-12 flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <hr class="my-3" />
            <div x-data="{ selected: [] }">
                <div class="flex flex-row">
{{--                    @foreach($images as $image)--}}
{{--                        <img x-bind:class="selected[{{$loop->index}}] ? 'border-4 border-indigo-800' : 'border'" x-on:click="selected[{{$loop->index}}] ? delete selected[{{$loop->index}}] : selected[{{$loop->index}}] = {{$image}}" src="{{$image->path}}" class="w-1/4 object-cover" />--}}
{{--                    @endforeach--}}
{{--                    @foreach($images as $image)--}}
{{--                        <img wire:click="{{$image['selected'] = !$image['selected']}}" src="{{$image->path}}" class="w-1/4 object-cover" />--}}
{{--                    @endforeach--}}
                    @foreach ($images as $image)
                        <img src="{{$image->path}}" class="w-1/4 object-cover"/>
                    @endforeach
                </div>
                <div>
                    {{$images}}
                </div>
            </div>
        </x-modal>
    </div>
    <x-manage-tags-modal trigger="showTagManagementModal"></x-manage-tags-modal>
    <x-manage-attributes-modal trigger="showAttributeManagementModal"></x-manage-attributes-modal>
</div>
