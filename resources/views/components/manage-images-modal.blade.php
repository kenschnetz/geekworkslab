@props(['trigger'])

<div class="absolute top-0 left-0">
    <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showImageManagementModal">
        <p class="text-xl font-bold">Manage Images</p>
        <hr class="my-3" />
        <div class="flex items-center">
            <input wire:model="search_term" class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Filter" wire:model.lazy="search_term">
        </div>
        <hr class="my-3" />
        <div class="grid grid-cols-2 md:grid-cols-4">
            @foreach($images as $image)
                <div wire:click="ToggleImage({{$image}})" style="background-image: url({{$image->path}});" class="image-management-square object-cover cursor-pointer {{ empty($selected_images[$image->id]) ? 'border' : 'border-2 border-indigo-800' }}"></div>
            @endforeach
        </div>
        <div class="my-3 italic">
            Images selected: {{count($selected_images)}} of 4
        </div>
        @if ($images->hasPages())
            <hr class="my-3" />
        @endif
        {{ $images->links() }}
        <hr class="my-3" />
        <a wire:click="CloseModal()" class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
            Done
        </a>
    </x-modal>
</div>
