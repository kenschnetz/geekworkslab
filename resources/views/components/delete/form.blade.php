<div>
    <form wire:submit.prevent="Delete">
        <div class="mt-4">
            Are you sure you would like to delete {{$name}}?
        </div>
        <div class="mt-4">
            <strong>NOTE: </strong> This cannot be undone
        </div>
        <hr class="mt-4"/>
        <div class="flex items-center mt-4">
            <x-jet-nav-link href="">
                Cancel
            </x-jet-nav-link>
            <x-jet-button style="margin-left: auto !important;">
                Confirm Delete
            </x-jet-button>
        </div>
    </form>
</div>
