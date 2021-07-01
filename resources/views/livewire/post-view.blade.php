<div>
    <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <div>
            <p class="text-center md:text-left text-lg font-bold">
                {{ $post->title . ($post->content_type_id === 2 ? ' (Art only)' : '') }}
            </p>
            <p class="mb-1 md:mb-0 text-center md:text-left text-lg italic">
                {{$post->description}}
            </p>
            <hr class="hidden md:block my-3" />
            @if($post->content_type_id === 2)
                <div class="w-full md:w-3/4 lg:w-1/2 mx-auto">
                    <img class="w-full border" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
                </div>
                <hr class="my-3" />
            @else
                <p class="md:hidden">
                    <img class="sm-post-img border mt-3 mx-auto" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
                </p>
                <p class="mt-3 md:mt-0 text-center md:text-left text-sm">
                    By <a class="underline hover:no-underline" href="{{ route('profile', ['user_id' => $post->User->id]) }}">{{ $post->User->name }}</a><span class="mx-3">|</span>
                    <a class="underline hover:no-underline" href="#comments">{{$post->all_comments_count . ($post->all_comments_count === 0 || $post->all_comments_count > 1 ? ' Comments' : ' Comment')}}</a><span class="mx-3">|</span>
                    {{$post->upvotes_count . ($post->upvotes_count === 0 || $post->upvotes_count > 1 ? ' Upvotes' : ' Upvote')}}
                </p>
                <hr class="my-3" />
                <img class="hidden md:block w-full md:w-1/3 float-left mr-4 mb-1 border" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  alt="Post image"/>
            @endif
            <p>
                {{ $post->content }}
            </p>
            @if(count($post->Attributes) > 0)
                <hr class="my-3" />
                <div class="grid grid-cols-3 gap-4">
                    @foreach($post->Attributes as $attribute)
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
                    <span>{{ $tag->name }}{{($loop->last ? '' : ', ') }}</span>
                    {{--TODO: send user to a search page when tag is clicked--}}
                @endforeach
            </p>
        @endif
        @if(Auth::id() === $post->user_id)
            <hr class="my-3" />
            <p class="italic mb-3">
                Author tools:
            </p>
            <div x-data="{ deleting: false }" x-cloak>
                <div x-show="!deleting">
                    <a href="{{ route('post-edit', ['post_id' => $post->id]) }}" class="w-full md:w-1/6 text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">Edit</a>
                    <a class="w-full mt-3 md:mt-0 md:w-1/6 text-center cursor-pointer inline-block bg-red-700 hover:bg-transparent text-white hover:text-red-800 font-bold px-4 py-3 border border-red-700" x-on:click="deleting = true">Delete</a>
                </div>
                <div x-show="deleting">
                    <a class="w-full md:w-1/6 text-center cursor-pointer inline-block bg-green-500 hover:bg-transparent text-white hover:text-green-800 font-bold px-4 py-3 border border-green-500" x-on:click="deleting = false">Cancel</a>
                    <a class="w-full mt-3 md:mt-0 md:w-1/6 text-center cursor-pointer inline-block bg-red-700 hover:bg-transparent text-white hover:text-red-800 font-bold px-4 py-3 border border-red-700" wire:click="DeletePost({{$post->id}})">Confirm Delete</a>
                </div>
            </div>
        @endif
    </div>
    <div id="comments" class="mt-8 p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
        <p class="text-center md:text-left text-lg font-bold">
            Comments
        </p>
        @if(Auth::check())
            <hr class="my-3" />
            @if($replying)
                <div class="mb-4">
                    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="font-semibold mr-2 text-left flex-auto">Responding to {{$replying_to_name}}: "<i>{{$replying_to_content}}</i>"</span>
                        <i class="ml-3 far fa-times-circle cursor-pointer" wire:click="ClearCommentForm()"></i>
                    </div>
                </div>
            @endif
            @if($editing)
                <div class="mb-4">
                    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="font-semibold mr-2 text-left flex-auto">Editing</span>
                        <i class="ml-3 far fa-times-circle cursor-pointer" wire:click="ClearCommentForm()"></i>
                    </div>
                </div>
            @endif
            <form id="comment-form" wire:submit.prevent="SubmitComment">
                @csrf
                <div class="flex w-full">
                    <label class="sr-only" for="comment-content"></label>
                    <input wire:model.defer="comment_content" type="text" class="form-input px-4 py-3 rounded-l-md flex-grow border-indigo-800 focus:outline-none focus:border-indigo-800 border-r-0" placeholder="Say something nice!" id="comment-content">
                    <button type="submit" class="bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800 rounded-r">
                        Submit
                    </button>
                </div>
                @error('comment_content')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline">{{$message}}</span>
                    </div>
                @enderror
            </form>
        @else
            <p class="font-semibold text-gray-900 my-3 italic">
                You must be logged in to comment.
            </p>
        @endif
        <hr class="my-3" />
        @if(count($comments) > 0)
            @foreach($comments as $comment)
                @livewire('post-comment', ['user_id' => $user_id, 'post' => $post, 'comment' => $comment], key($comment->id))
            @endforeach
            <hr class="my-3" />
            {{ $comments->links() }}
        @else
            <div>
                <p class="font-semibold text-gray-900 my-3">
                    No comments yet. You should be the first to leave one!
                </p>
            </div>
        @endif
    </div>
</div>
