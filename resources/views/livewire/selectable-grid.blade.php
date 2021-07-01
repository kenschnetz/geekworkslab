<div x-data="{ showImageManagementModal: @entangle('showImageManagementModal') }">
    <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <div>
            <p class="italic font-md my-3">
{{--                @if(count($selected_images) > 0)--}}
{{--                    @foreach($selected_images as $selected_image)--}}
{{--                        {{$selected_image->name . $loop->last() ? '' : ', ' }}--}}
{{--                    @endforeach--}}
{{--                @else--}}
                    No Images selected
{{--                @endif--}}
            </p>
            <a x-on:click="showImageManagementModal = true" class="cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                Manage Images
            </a>
        </div>
    </div>
    <div class="absolute top-0 left-0">
        <div class="flex fixed top-0 bg-gray-900 bg-opacity-60 items-center w-full h-full" x-show="showImageManagementModal" x-on:mousedown.self="showImageManagementModal = false" x-on:keydown.escape.window="showImageManagementModal = false" x-cloak>
            <div class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8">
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
                <div class="grid grid-cols-2 md:grid-cols-4">
                    @foreach($images as $image)
                        <div wire:click="ToggleImage({{$image->id}})" style="background-image: url({{$image->path}});" class="image-management-square object-cover cursor-pointer {{ in_array($image->id, $selected_images) ? 'border-2 border-indigo-800' : 'border' }}"></div>
                    @endforeach
                </div>
                <hr class="my-3" />
                {{ $images->links() }}
            </div>
        </div>
    </div>
</div>
