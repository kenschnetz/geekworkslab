<div class="p-2 md:p-6 bg-white shadow rounded">
    <form id="comment-form" wire:submit.prevent="SendMessage">
        @csrf
        <div class="flex w-full">
            <label class="sr-only" for="comment-content"></label>
            <input wire:model="message" type="text" class="form-input px-4 py-3 rounded-l-md flex-grow border-indigo-800 focus:outline-none focus:border-indigo-800 border-r-0" placeholder="Join the conversation!" id="message">
            <button type="submit" class="bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800 rounded-r">
                Send
            </button>
        </div>
    </form>
    <hr class="mt-3" />
    <div class="mt-3" wire:poll>
        @if(App\Models\PublicMessage::count() > 0)
            @foreach(App\Models\PublicMessage::latest()->limit(100)->get() as $message)
                <div wire:key="{{ $message->id }}">
                    <div class="mt-3">
                        <strong><a class="-underline text-blue-500" href="{{ route('profile', ['user_id' => $message->User->id]) }}">{{$message->User->name}}</a></strong> says:
                        <span class="inline-block float-right text-xs">{{ $this->MessageDate($message->created_at) }}</span>
                    </div>
                    <div class="mt-3">
                        {{ $message->content }}
                    </div>
                    <div class="py-3" x-data="{ deleting: false }" x-cloak>
                        @if(Auth::user()->id === $message->user_id || Auth::user()->role_id === 1)
                            <div x-show="!deleting">
                                <a class="inline-block text-xs align-bottom cursor-pointer" x-on:click="deleting = true"><i>Delete</i></a>
                            </div>
                            <div x-show="deleting">
                                <a class="inline-block text-xs align-bottom cursor-pointer" x-on:click="deleting = false"><i>Cancel</i></a>
                                .
                                <a class="inline-block text-xs align-bottom cursor-pointer text-red-700" wire:click="DeleteMessage({{$message->id}})"><i>Confirm Delete</i></a>
                            </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                        <hr class="mt-3" />
                    @endif
                </div>
            @endforeach
        @else
            No recent public messages found
        @endif
    </div>
</div>
