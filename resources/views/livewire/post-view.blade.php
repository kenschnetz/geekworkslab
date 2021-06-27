<div>
    <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <div>
            <p class="text-center md:text-left text-lg font-bold">
                {{ $post->title }}
            </p>
            <p class="mb-1 md:mb-0 text-center md:text-left text-lg italic">
                {{$post->description}}
            </p>
            <hr class="hidden md:block my-3" />
            <p class="md:hidden">
                <img class="sm-post-img border mt-3 mx-auto" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
            </p>
            <p class="mt-3 md:mt-0 text-center md:text-left text-sm">
                By <a class="underline hover:no-underline" href="{{ route('profile', ['user_id' => $post->User->id]) }}">{{ $post->User->name }}</a><span class="mx-3">|</span>
                <a class="underline hover:no-underline" href="#comment-form">{{$post->all_comments_count . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}</a><span class="mx-3">|</span>
                {{$post->upvotes_count . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}
            </p>
            <hr class="my-3" />
            <img class="hidden md:block w-full md:w-1/3 float-left mr-4 mb-1 border" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
            <p>
                {{ $post->content }}
            </p>
            @if(count($post->PostAttributes) > 0)
                <hr class="my-3" />
                <div class="grid grid-cols-3 gap-4">
                    @foreach($post->PostAttributes as $attribute)
                        <div class="flex p-3 border items-center">
                            <span><strong>{{ $attribute->Attribute->name }}</strong>: {{ $attribute->value }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        @if(count($post->tags) > 0)
            <hr class="my-3" />
            <p>
                <strong>Tags:</strong>
                @foreach($post->Tags as $tag)
                    <span><a href="#" class="underline">{{ $tag->name }}</a>{{($loop->last ? '' : ', ') }}</span>
                    {{--TODO: send user to a search page when tag is clicked--}}
                @endforeach
            </p>
        @endif
    </div>
    <div class="mt-8 p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <p class="text-center md:text-left text-lg font-bold">
            Comments
        </p>
        <hr class="my-3" />
        <form id="comment-form" wire:submit.prevent="Submit">
            @csrf
            <div class="flex w-full">
                <label class="sr-only" for="comment-content"></label>
                <input type="text" class="form-input px-4 py-3 rounded-l-md flex-grow border-blue-100 border-r-0" placeholder="Say something nice!" id="comment-content" wire:model.lazy="comment_content">
                <button type="submit" class="bg-blue-500 hover:bg-transparent text-white hover:text-blue-700 font-bold px-4 py-3 border border-blue-100 rounded-r">
                    Submit
                </button>
            </div>
            @error('comment_content')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{$mesasge}}</span>
            </div>
            @enderror
        </form>
        <hr class="my-3" />
        @if(count($post->Comments) > 0)
            @foreach($post->Comments as $comment)
                <div wire:key="{{ $loop->index }}">
                    @include('components.comment')
                </div>
            @endforeach
        @else
            <div>
                <p class="font-semibold text-gray-900 my-3">
                    No comments yet. You should be the first to leave one!
                </p>
            </div>
        @endif
    </div>
</div>
