<div class="relative">
    <div class="relative max-w-4xl mx-auto">
        <div class="mt-12 max-w-lg mx-auto lg:max-w-none">

            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden grid lg:grid-cols-2 p-4">
                    <h2  wire:click="View({{$post->id}})" class="hover:underline cursor-pointer">
                        {{ $post->name }}
                    </h2>
                </div>
            @endforeach

        </div>
    </div>
</div>
