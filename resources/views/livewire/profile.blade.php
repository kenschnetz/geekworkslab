<div>
    <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4">
        <div class="col md:col-span-2 lg:col-span-3">
            <div class="p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">{{ $user->name }}</p>
                <hr class="my-3"/>
                <p class="italic">Member
                    since {{ Illuminate\Support\Carbon::parse($user->created_at)->format('F j, Y') }}</p>
                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <div class="p-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Posts
                        </dt>
                        <dd class="mt-1 text-3xl font-bold text-gray-900">
                            {{$user->posts_count}}
                        </dd>
                    </div>
                    <div class="p-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Upvotes
                        </dt>
                        <dd class="mt-1 text-3xl font-bold text-gray-900">
                            {{$user->post_upvotes_count + $user->comment_upvotes_count}}
                        </dd>
                    </div>
                    <div class="p-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Comments
                        </dt>
                        <dd class="mt-1 text-3xl font-bold text-gray-900">
                            {{$user->comments_count}}
                        </dd>
                    </div>
                </div>
            </div>
            <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Badges</p>
                <hr class="my-3"/>
                <p class="italic font-md">Feature coming soon!</p>
            </div>
            <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="mb-3 text-xl font-bold">Posts</p>
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div wire:key="row-{{ $post->id }}">
                            <hr/>
                            <div class="flex items-center p-4 cursor-pointer hover:bg-gray-100" wire:click="View('{{$post->Category->slug}}', '{{$post->slug}}')">
                                <img class="hidden md:block object-cover float-left mr-4 mb-1 post-img" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image" />
                                <div class="w-full">
                                    <div class="text-center md:text-left text-lg font-bold underline">
                                        {{ $post->title }}
                                    </div>
                                    <div class="text-center md:text-left text-lg italic">
                                        {{$post->description}}
                                    </div>
                                    <div class="md:hidden">
                                        <img class="sm-post-img border mt-3 mx-auto" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
                                    </div>
                                    <hr class="my-1 border-gray-100 hidden md:block" />
                                    <div class="py-0 md:py-1 mt-3 md:mt-0 text-center md:text-left text-sm">
                                        By {{ $post->User->name }}<span class="mx-3">|</span>
                                        {{$post->all_comments_count . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}<span class="mx-3">|</span>
                                        {{$post->upvotes_count . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}
                                    </div>
{{--                                    <hr class="my-3 md:my-1 border-gray-100" />--}}
{{--                                    <div class="py-1">--}}
{{--                                        {!! Str::limit($post->content, 120) !!}--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr class="my-3"/>
                    {{ $posts->links() }}
                @else
                    <hr class="my-3"/>
                    <p class="italic font-md">No posts yet!</p>
                @endif
            </div>
        </div>
        <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
            <p class="text-xl font-bold">Activity Feed</p>
            <hr class="my-3" />
            <p class="italic font-md">Feature coming soon!</p>
        </div>
    </div>
</div>
