<div class="p-2 md:px-6 bg-white shadow rounded">
    <div class="flex items-center">
        <input class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Filter">
        <div class="-ml-16">
            <button class="text-gray-500 rounded-full px-6 py-2 focus:outline-none h-12 flex items-center justify-center">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    @if(count($posts) > 0)
        <div class="flex flex-col pt-8">
            @foreach($posts as $post)
                <hr/>
                <div class="flex items-center p-4 cursor-pointer hover:bg-gray-100" wire:key="row-{{ $post->id }}" wire:click="View('{{$post->Category->slug}}', '{{$post->slug}}')">
                    <img class="hidden md:block object-cover float-left mr-4 mb-1 post-img" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image" />
                    <div class="w-full">
                        <p class="text-center md:text-left text-lg font-bold underline">
                            {{ $post->title }}
                        </p>
                        <p class="text-center md:text-left text-lg italic">
                            {{$post->description}}
                        </p>
                        <p class="md:hidden">
                            <img class="sm-post-img border mt-3 mx-auto" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
                        </p>
                        <hr class="my-1 border-gray-100 hidden md:block" />
                        <p class="py-0 md:py-1 mt-3 md:mt-0 text-center md:text-left text-sm">
                            By <a class="underline hover:no-underline" href="{{ route('profile', ['user_id' => $post->User->id]) }}">{{ $post->User->name }}</a><span class="mx-3">|</span>
                            {{$post->all_comments_count . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}<span class="mx-3">|</span>
                            {{$post->upvotes_count . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}
                        </p>
                        <hr class="my-3 md:my-1 border-gray-100" />
                        <p class="py-1">
                            <span class="hidden xl:block">{{ Str::limit($post->content, 240) }}</span>
                            <span class="hidden lg:block xl:hidden">{{ Str::limit($post->content, 180) }}</span>
                            <span class="hidden md:block lg:hidden">{{ Str::limit($post->content, 100) }}</span>
                            <span class="md:hidden">{{ Str::limit($post->content, 300) }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

{{--        <x-table>--}}
{{--            <x-slot name="head"></x-slot>--}}
{{--            <x-slot name="body">--}}
{{--                @foreach($posts as $post)--}}
{{--                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $post->id }}" wire:click="View('{{$post->Category->slug}}', '{{$post->slug}}')">--}}
{{--                        <x-table.cell style="width: 180px;">--}}
{{--                            <img class="object-cover float-left post-list-img" src="{{ optional($post->Images->first())->path ?? $default_image_url }}">--}}
{{--                        </x-table.cell>--}}
{{--                        <x-table.cell>--}}
{{--                            <p class="text-lg font-bold">--}}
{{--                                {{ $post->title }}--}}
{{--                            </p>--}}
{{--                            <p class="text-lg">--}}
{{--                                {{$post->description}}--}}
{{--                            </p>--}}
{{--                            @if(!empty($post->content))--}}
{{--                                <hr class="my-1 border-gray-100" />--}}
{{--                                <p class="py-1">--}}
{{--                                    {{ Str::limit($post->content, 200) }}--}}
{{--                                </p>--}}
{{--                            @endif--}}
{{--                            <hr class="my-1 border-gray-100" />--}}
{{--                            <p class="mt-3">--}}
{{--                                {{$this->ShortenBigNumber($post->all_comments_count) . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}<span class="mx-3">|</span>--}}
{{--                                {{$this->ShortenBigNumber($post->upvotes_count) . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}--}}
{{--                            </p>--}}
{{--                        </x-table.cell>--}}
{{--                    </x-table.row>--}}
{{--                @endforeach--}}
{{--            </x-slot>--}}
{{--        </x-table>--}}
    @else
        <h2 class="text-xl">No content found!</h2>
    @endif
</div>
