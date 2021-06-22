<div class="relative">
    <div class="mt-12">
        @if(count($post_categories) > 0)
            <x-table>
                <x-slot name="head">
{{--                        <x-table.heading>Thumbnail</x-table.heading>--}}
{{--                        <x-table.heading>Name</x-table.heading>--}}
{{--                        <x-table.heading>Description</x-table.heading>--}}
{{--                        <x-table.heading>Upvotes</x-table.heading>--}}
{{--                        <x-table.heading>Downvotes</x-table.heading>--}}
{{--                        <x-table.heading>Comments</x-table.heading>--}}
                </x-slot>
                <x-slot name="body">
                    @foreach($post_categories as $post_category)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $post_category->Post->id }}" wire:click="View({{$post_category->Post->id}})">
                            <x-table.cell>
                                <img class="w-full object-cover float-left" src="{{$post_category->Post->meta->image_url}}" style="width: 100%; max-width: 80px;">
                            </x-table.cell>
                            <x-table.cell>
                                <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                    <p class="text-cool-gray-600">
                                        <strong>{{ $post_category->Post->meta->name }}</strong>
                                    </p>
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                {{$post_category->Post->meta->description}}
                            </x-table.cell>
{{--                                <x-table.cell class="text-center">--}}
{{--                                    {{$post_category->Post->upvotes}}--}}
{{--                                </x-table.cell>--}}
{{--                                <x-table.cell class="text-center">--}}
{{--                                    {{$post_category->Post->downvotes}}--}}
{{--                                </x-table.cell>--}}
{{--                                <x-table.cell class="text-center">--}}
{{--                                    {{$post_category->Post->comment_count}}--}}
{{--                                </x-table.cell>--}}
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            No records found! Please check back later.
        @endif
    </div>
</div>
