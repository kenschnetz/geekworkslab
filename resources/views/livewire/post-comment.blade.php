<div>
    <div class="py-3">
        <strong>{{$comment->User->name}}</strong> says:
        <span class="inline-block float-right text-xs">{{ $this->CommentDate($comment->created_at) }}</span>
    </div>
    <div class="my-3">
        {{$comment->content}}
    </div>
    @auth
        <div class="py-3" x-data="{ deleting: false }" x-cloak>
            @if($user_id === $comment->user_id)
                <div x-show="!deleting">
                    <a href="#comments" class="inline-block text-xs align-bottom cursor-pointer" wire:click="EditComment({{$comment->id}}, {{$comment->post_comment_id}}, '{{addslashes($comment->content)}}')"><i>Edit</i></a>
                    .
                    <a class="inline-block text-xs align-bottom cursor-pointer" x-on:click="deleting = true"><i>Delete</i></a>
                </div>
                <div x-show="deleting">
                    <a class="inline-block text-xs align-bottom cursor-pointer" x-on:click="deleting = false"><i>Cancel</i></a>
                    .
                    <a class="inline-block text-xs align-bottom cursor-pointer text-red-700" wire:click="DeleteComment({{$comment->id}})"><i>Confirm Delete</i></a>
                </div>
            @else
                <a href="#comments" class="inline-block text-xs align-bottom cursor-pointer" wire:click="ReplyingTo({{$comment->id}}, '{{$comment->User->name}}', '{{addslashes(Str::limit($comment->content, 200))}}')"><i>Reply</i></a>
            @endif
        </div>
    @endauth
    @foreach($comment->Comments as $comment)
        <div class="ml-3 pl-3 border-l border-t">
            @livewire('post-comment', ['user_id' => $user_id, 'post' => $post, 'comment' => $comment], key($comment->id))
        </div>
    @endforeach
</div>
