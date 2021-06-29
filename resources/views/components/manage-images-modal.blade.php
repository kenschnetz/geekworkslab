@props(['trigger'])

<div class="absolute top-0 left-0">
    <x-modal class="w-1/2 h-1/2" trigger="{{ $trigger }}">
        Image management modal
        {{$images}}
    </x-modal>
</div>
