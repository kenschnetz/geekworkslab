<div class="p-8 bg-white shadow rounded">
    <div class="grid grid-cols-3">
        <div>
            <img class="w-full object-cover" src="{{ optional($post->Images->first())->path ?? $default_image_url }}"  style="min-width: 100%; min-height: 100%;" />
        </div>
        <div class="col-span-2 pl-6">
            <p class="text-lg font-bold">
                {{ $post->title }}
            </p>
            <p class="text-lg">
                {{$post->description}}
            </p>
            <hr class="my-3" />
            <p>
                By {{ $post->User->name }} <span class="mx-3">|</span> Last Updated: {{ \Carbon\Carbon::parse($post->updated_at)->format('j F, Y') }} <span class="mx-3">|</span> <a href="#comments">{{$post->comment_count}} Comments</a>
            </p>
            <hr class="my-3" />
        </div>
    </div>
    <hr class="my-3" />
    <div>
        {{ $post->content }}
    </div>
</div>
