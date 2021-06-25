<div class="p-8 bg-white shadow rounded">
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
                                <hr class="my-1" />
                                {{ strlen($post->content) > 200 ? substr($post->content, 0, 200) . '...' : $post->content }}
                            @endif
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @else
        <h2 class="text-xl">No content found!</h2>
    @endif
</div>
