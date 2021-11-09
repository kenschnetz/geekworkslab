<div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
    To continue using Geekworks Lab, you must accept the Terms and Conditions first.
    <div class="mt-4 w-full">
        <div class="relative inline-block mr-4 align-middle select-none transition duration-200 ease-in">
            <input wire:model="user.terms_accepted" type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
            <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
        </div>
        <div class="relative inline-block ml-4">
            I, {{ $user->name }}, accept the Geekworks Studios <a class="underline text-blue-500" href="{{ route('terms') }}" target="_blank">Terms and Conditions</a>
        </div>
    </div>
    @error('user.accept_terms')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
    <hr class="mt-4"/>
    <div class="flex items-rightr mt-4">
        <button wire:click="AcceptTerms()" class="inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
            {{ 'Submit' }}
        </button>
    </div>
</div>
