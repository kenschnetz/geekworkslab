@props(['trigger'])

<div class="flex fixed top-0 bg-gray-900 bg-opacity-60 items-center w-full h-full" x-show="{{ $trigger }}" x-cloak>
    <div {{ $attributes->merge(['class' => 'w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8']) }} style="max-height: 80% !important; overflow: scroll !important;">
        {{ $slot }}
    </div>
</div>
