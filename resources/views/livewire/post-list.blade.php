<div class="p-8 bg-white shadow rounded">
    <div class="flex items-center">
        <input class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Filter">
        <div class="-ml-16">
            <button class="text-gray-500 rounded-full px-6 py-2 focus:outline-none h-12 flex items-center justify-center">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    @if(count($posts) > 0)
        <x-table>
            <x-slot name="head"></x-slot>
            <x-slot name="body">
                @foreach($posts as $post)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $post->id }}" wire:click="View('{{$post->slug}}')">
                        <x-table.cell style="width: 180px;">
                            <img class="object-cover float-left" src="{{ optional($post->Images->first())->path ?? $default_image_url }}" style="min-width: 160px; min-height: 160px; overflow: hidden;">
                        </x-table.cell>
                        <x-table.cell>
                            <p class="text-lg font-bold">
                                {{ $post->title }}
                            </p>
                            <p class="text-lg">
                                {{$post->description}}
                            </p>
                            @if(!empty($post->content))
                                <hr class="my-1 border-gray-100" />
                                <p class="py-1">
                                    {{ Str::limit($post->content, 200) }}
                                </p>
                            @endif
                            <hr class="my-1 border-gray-100" />
                            <p class="mt-6">
                                <i class="fas fa-comment fa-lg"></i>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-500 bg-gray-100 border border-gray-400 rounded-full transform -translate-y-2/3">
                                    {{ $this->FormatStat($post->all_comments_count) }}
                                </span>
                                <i class="fas fa-thumbs-up fa-lg ml-6"></i>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-500 bg-gray-100 border border-gray-400 rounded-full transform -translate-y-2/3">
                                    {{ $this->FormatStat($post->upvotes_count) }}
                                </span>
                            </p>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @else
        <h2 class="text-xl">No content found!</h2>
    @endif
</div>
