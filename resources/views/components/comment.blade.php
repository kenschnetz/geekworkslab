<div>
    <div class="my-3">
        <strong>{{$comment->User->name}}</strong> says:
        <span class="inline-block float-right text-xs">{{ \Carbon\Carbon::parse($comment->created_at)->format('j F, Y \a\t g:i A') }}</span>
    </div>
    <div class="my-3">
        {{$comment->content}}
    </div>
    <div class="my-3" x-data="{ reply: false, edit: false }" x-cloak>
        @auth
            @if($user_id === $comment->user_id)
                <a x-show="!edit" class="inline-block text-xs align-bottom cursor-pointer" x-on:click="edit = true" wire:click="EditComment('{{$comment->content}}', {{$comment->id}})"><i>Edit</i></a>
                <a x-show="!edit"> . </a>
                <a x-show="!edit" class="inline-block text-xs align-bottom cursor-pointer" wire:click="DeleteComment({{$comment->id}})"><i>Delete</i></a>
            @else
                <a x-show="!reply" class="inline-block text-xs align-bottom cursor-pointer" x-on:click="reply = true" wire:click="Replying()"><i>Reply</i></a>
            @endif
        @endauth
        <div x-show="reply">
            <div class="flex items-center py-2">
                <x-jet-input wire:model="reply_content" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Be nice..."></x-jet-input>
                <x-jet-button @click="reply = false" class="flex-shrink-0 border-transparent border-radius-r-none text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="button">
                    Cancel
                </x-jet-button>
                <x-jet-button @click="reply = false" wire:click="SubmitComment({{$comment->id}}, 1)" type="submit" class="flex-shrink-0 px-4 py-2 border border-transparent border-radius-l-none text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Send It
                </x-jet-button>
            </div>
        </div>
        <div x-show="edit">
            <div class="flex items-center py-2">
                <x-jet-input wire:model="edit_content" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Be nice..."></x-jet-input>
                <x-jet-button @click="edit = false" class="flex-shrink-0 border-transparent border-radius-r-none text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="button">
                    Cancel
                </x-jet-button>
                <x-jet-button @click="edit = false" wire:click="SubmitComment(null, 2)" type="submit" class="flex-shrink-0 px-4 py-2 border border-transparent border-radius-l-none text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Send It
                </x-jet-button>
            </div>
        </div>
    </div>
    @foreach($comment->PostComments as $comment)
        <div class="ml-3 border-l border-t" wire:key="{{ $loop->index }}">
            <div class="pl-3">
                @include('components.comment')
            </div>
        </div>
    @endforeach
</div>
