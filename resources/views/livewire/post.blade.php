<div class="relative">
    <div class="mt-12 bg-white border-b border-gray-200 p-3">
        <div class="text-2xl font-semibold text-gray-900 text-center">
            {{$post->meta->name}}
        </div>
        <div class="text-gray-500 text-center">
            By {{$post->User->name}} <span class="mx-3">|</span> Last Updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('j F, Y') }} <span class="mx-3">|</span> Version: {{$post->meta->version}}
        </div>
        <hr class="my-3"/>
        <div class="relative">
            <div class="relative max-w-4xl mx-auto">
                <div class="mt-12 max-w-lg mx-auto lg:max-w-none">
                    <div class="overflow-hidden grid lg:grid-cols-2">
                        <div class="flex flex-col">
                            <img class="w-full object-cover" src="{{$post->meta->image_url}}" style="min-width: 100%; min-height: 100%;">
                        </div>
                        <div class="p-6 flex flex-wrap content-center">
                            <div>
                                <p class="text-xl mt-3 text-base text-gray-500">
                                    {{$post->meta->description}}
                                </p>
                                <hr class="my-3"/>
                                <p class="mt-3 text-base text-gray-500">
                                    @foreach($post->meta->PostFields as $field)
                                        <strong>{{$field->name}}:</strong> {{$field->value}}<br/>
                                    @endforeach
                                </p>
                                <p class="text-base text-gray-500">
                                    <strong>Categories:</strong>
                                    @foreach($post->PostCategories as $post_category)
                                        {{$post_category->Category->name . ($loop->last ? '' : ', ')}}
                                    @endforeach
                                </p>
                                <p class="text-base text-gray-500">
                                    <strong>Tags:</strong>
                                    @foreach($post->PostTags as $post_tag)
                                        {{$post_tag->Tag->name . ($loop->last ? '' : ', ')}}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if($post->meta->content)
                            <hr class="my-3"/>
                            <p class="mt-3 text-base text-gray-500">
                                {{$post->meta->content}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-3"/>
        <div class="overflow-hidden grid lg:grid-cols-3">
            <div class="flex flex-col justify-center font-medium">
                <span class="inline-block align-middle">Upvotes: {{$post->upvotes}}</span>
            </div>
            <div class="flex flex-col">
                <span class="relative z-0 inline-flex shadow-sm rounded-md" style="display: flex;">
                    <button type="button" style="flex: 1;" class="w-3/12 align-center relative items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        Branch
                    </button>
                    <button type="button" style="flex: 1;" class="w-3/12 align-center -ml-px relative items-center px-4 py-2 border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        Edit
                    </button>
                    <button type="button" style="flex: 1;" class="w-3/12 align-center -ml-px relative items-center px-4 py-2 border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        Save
                    </button>
                    <button type="button" style="flex: 1;" class="w-3/12 align-center -ml-px relative items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        Share
                    </button>
                </span>
            </div>
            <div class="flex flex-col justify-center text-right font-medium">
                <span class="inline-block align-middle">Downvotes: {{$post->downvotes}}</span>
            </div>
        </div>
    </div>
    <div class="mt-6 p-4 bg-white border-gray-200" id="comments">
        <p class="text-2xl font-semibold text-gray-900 text-center mb-3">
            Comments
        </p>
        @guest
            <p class="text-sm font-semibold text-gray-900 text-center mb-3">
                <i>You must be logged in to leave a comment, reply to a comment, or rate other comments.</i>
            </p>
        @else
            <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center py-2">
                            <x-jet-input wire:model="comment_content" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Say something awesome!"></x-jet-input>
                            <x-jet-button wire:click="SubmitComment(null, 0, {{$post}})" class="flex-shrink-0 px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Send It
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
        @if(count($post->PostComments) > 0)
            @foreach($post->PostComments as $comment)
                <div class="border-t" wire:key="{{ $loop->index }}">
{{--                    @livewire('post-comment', ['post_comment' => $comment])--}}
                    @include('components.comment')
                </div>
            @endforeach
        @else
            <div class="border-t">
                <p class="font-semibold text-gray-900 my-3">
                    No comments yet. Why not leave one?
                </p>
            </div>
        @endif
    </div>

    @if($confirming_delete)
        @include('livewire.confirm-delete-modal')
    @endif
</div>
