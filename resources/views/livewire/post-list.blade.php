<div class="p-2 md:p-6 bg-white shadow rounded">
    <div class="flex items-center">
        <input class="w-full rounded py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Filter" wire:model="search_term">
    </div>
    <div class="flex flex-col pt-8">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div wire:key="row-{{ $post->id }}">
                    <hr/>
                    <div class="flex items-center p-4 cursor-pointer hover:bg-gray-100" wire:click="View('{{$post->Category->slug}}', '{{$post->slug}}')">
                        @if(!empty(optional($post->Images->first())->path))
                            <img class="hidden md:block object-cover float-left mr-4 mb-1 post-img" src="{{ optional($post->Images->first())->path }}"  alt="Post image" />
                        @endif
                        <div class="w-full">
                            <div class="text-center md:text-left text-xl font-bold">
                                <span class="underline">{{ $post->title }}</span><img src="/storage/img/{{ $this->Icon($post->category_id) }}.png" class="inline-block h-8 w-8 ml-4" />
                                @if($post->moderated)
                                    <img src="/storage/img/warning.png" class="inline-block h-8 w-8" /> <span class="text-sm italic text-red-500">This post has been moderated, please contact admin for resolution</span>
                                @endif
                            </div>
                            <div class="text-center md:text-left text-lg italic">
                                {{ Str::limit($post->description) }}
                            </div>
                            @if(!empty(optional($post->Images->first())->path))
                                <div class="md:hidden">
                                    <img class="sm-post-img border mt-3 mx-auto" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
                                </div>
                            @endif
                            <hr class="my-1 border-gray-100 hidden md:block" />
                            <div class="py-0 md:py-1 mt-3 md:mt-0 text-center md:text-left text-sm">
                                By {{ $post->User->name }}<span class="mx-3">|</span>
                                {{$post->all_comments_count . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}<span class="mx-3">|</span>
                                {{$post->upvotes_count . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}
                            </div>
                            <hr class="my-3 md:my-1 border-gray-100" />
                            <div class="py-1">
                                {!! strip_tags(Str::limit($post->content, 200), '<strong><em><del><br><a>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr class="my-3"/>
            {{ $posts->links() }}
        @else
            <h2 class="text-xl">No content found!</h2>
        @endif
    </div>
</div>
