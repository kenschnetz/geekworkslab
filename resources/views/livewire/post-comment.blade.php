<div>
    <p class="my-3">
        <strong>{{$post_comment->User->name}}</strong> says:
        <span class="inline-block float-right text-xs">{{ \Carbon\Carbon::parse($post_comment->created_at)->format('j F, Y \a\t g:i A') }}</span>
    </p>
    <p class="my-3">
        {{$post_comment->content}}
        @auth
            <span class="inline-block text-xs align-bottom ml-4"><i>Reply</i></span>
        @endauth

    </p>
    <div class="ml-3 pl-3 border-l">
        @foreach($post_comment->PostComments as $post_comment)
            @livewire('post-comment', ['post_comment' => $post_comment])
        @endforeach
    </div>
</div>
