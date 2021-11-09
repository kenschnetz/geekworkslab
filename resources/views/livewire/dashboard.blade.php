<div x-data="{ showInviteModal: @entangle('showInviteModal'), showInviteSuccessModal: @entangle('showInviteSuccessModal'), showPasswordResetModal: @entangle('showPasswordResetModal'), showPasswordResetSuccessModal: @entangle('showPasswordResetSuccessModal'), }">
    <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4">
        <div class="col md:col-span-2 lg:col-span-3">
            <div class="p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Welcome back {{ $user->name }}!</p>
                <hr class="my-3" />
                <p class="italic font-md">What would you like to do?</p>
                <div class="mt-5 grid md:grid-cols-2 lg:grid-cols-4 gap-1">
                    <div>
                        <a href="{{route('post-edit')}}" class="w-full mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                            Create Post
                        </a>
                    </div>
                    <div>
                        <a href="{{route('author-posts', ['user_id' => $user->id])}}" class="w-full mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                            Your Posts
                        </a>
                    </div>
                    <div>
                        <a href="{{route('profile', ['user_id' => $user->id])}}" class="w-full mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                            Your Profile
                        </a>
                    </div>
                    <div>
                        <a href="{{route('collections', ['user_id' => $user->id])}}" class="w-full mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                            Your Collections
                        </a>
                    </div>
                </div>
            </div>
            @if($isStaff)
                <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                    <p class="text-xl font-bold">Staff Tools</p>
                    <hr class="my-3" />
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-1">
                        <div>
                            <a wire:click="ToggleInviteModal()" class="w-full text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                                Add User
                            </a>
                        </div>
                        <div>
                            <a wire:click="TogglePasswordResetModal()" class="w-full text-center cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                                Password Reset
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Recent Contributions To Your Posts</p>
                <hr class="my-3" />
                <p class="italic font-md">Feature coming soon!</p>
            </div>
            <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Recent Comments On Your Posts</p>
                <hr class="my-3" />
                <p class="italic font-md">Feature coming soon!</p>
            </div>
            <div class="mt-6 p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Your Flagged Content</p>
                <hr class="my-3" />
                <p class="italic font-md">Feature coming soon!</p>
            </div>
        </div>
        <div class="p-3 md:px-6 md:py-4 bg-white shadow rounded flex flex-col">
            <p class="text-xl font-bold">Activity Feed</p>
            <hr class="my-3" />
            <p class="italic font-md">Feature coming soon!</p>
        </div>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showInviteModal">
            <p class="text-xl font-bold">Add User</p>
            <hr class="my-3" />
            <div x-cloak>
                <form class="w-full" id="new-user-form" wire:submit.prevent="AddUser()">
                    @csrf
                    <div class="w-full p-3">
                        <input class="appearance-none bg-transparent w-full text-gray-700 p-2 leading-tight focus:outline-none" type="text" wire:model.defer="new_user.name" placeholder="Name">
                        @error('new_user.name')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                        <input class="mt-3 appearance-none bg-transparent w-full text-gray-700 p-2 leading-tight focus:outline-none" type="text" wire:model.defer="new_user.email" placeholder="Email">
                        @error('new_user.email')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                        <input class="mt-3 appearance-none bg-transparent w-full text-gray-700 p-2 leading-tight focus:outline-none" type="text" wire:model.defer="new_user.generated_password" placeholder="Password">
                        @error('new_user.generated_password')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                        <a wire:click="GeneratePassword()" class="cursor-pointer inline-block text-indigo-800 py-3 italic">
                            Generate Password
                        </a>
                        <div class="mt-4 w-full">
                            <select class="form-control mt-1 w-full" name="role" wire:model="new_user.role_id">
                                <option value="null">Select Role</option>
                                <option value="{{ 1 }}">
                                    Geekworks Superadmin
                                </option>
                                <option value="{{ 2 }}">
                                    Moderator
                                </option>
                                <option value="{{ 3 }}">
                                    Member
                                </option>
                            </select>
                            @error('new_user.role_id') <span class="text-red-500">Content Type is required</span> @enderror
                        </div>
                        <hr class="my-3" />
                        <a wire:click="ToggleInviteModal()" class="float-left cursor-pointer inline-block text-indigo-800 font-bold hover:underline px-4 py-3">
                            Cancel
                        </a>
                        <button class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showInviteSuccessModal">
            <p class="text-xl font-bold">Success!</p>
            <hr class="my-3" />
            <div x-cloak>
                <p class="text-lg font-bold">New user info:</p>
                <p>Name: {{ $new_user['name'] }}</p>
                <p>Email: {{ $new_user['email'] }}</p>
                <p>Password: <code>{{ $new_user['generated_password'] }}</code></p>
            </div>
            <hr class="my-3" />
            <a wire:click="ToggleInviteSuccessModal()" class="float-left cursor-pointer inline-block text-indigo-800 font-bold hover:underline px-4 py-3">
                Close
            </a>
        </x-modal>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showPasswordResetModal">
            <p class="text-xl font-bold">Password Reset</p>
            <hr class="my-3" />
            <div x-cloak>
                <form class="w-full" id="new-user-form" wire:submit.prevent="ResetUserPassword()">
                    @csrf
                    <div class="w-full p-3">
                        <input class="mt-3 appearance-none bg-transparent w-full text-gray-700 p-2 leading-tight focus:outline-none" type="text" wire:model="password_reset.email" placeholder="Email">
                        @error('password_reset.email')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                        <input class="mt-3 appearance-none bg-transparent w-full text-gray-700 p-2 leading-tight focus:outline-none" type="text" wire:model="password_reset.password" placeholder="Password">
                        @error('password_reset.password')<p class="my-3 italic text-red-700">{{ $message }}</p>@enderror
                        <a wire:click="GeneratePassword(false)" class="cursor-pointer inline-block text-indigo-800 py-3 italic">
                            Generate Password
                        </a>
                        <hr class="my-3" />
                        <a wire:click="TogglePasswordResetModal()" class="float-left cursor-pointer inline-block text-indigo-800 font-bold hover:underline px-4 py-3">
                            Cancel
                        </a>
                        <button class="float-right cursor-pointer inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
    <div class="absolute top-0 left-0">
        <x-modal class="w-full lg:w-2/3 xl:w-1/2 m-6 lg:m-auto bg-white shadow-2xl rounded-xl p-8" trigger="showPasswordResetSuccessModal">
            <p class="text-xl font-bold">Success!</p>
            <hr class="my-3" />
            <div x-cloak>
                <p>New password: <code>{{ $password_reset['password'] }}</code></p>
            </div>
            <hr class="my-3" />
            <a wire:click="TogglePasswordResetSuccessModal()" class="float-left cursor-pointer inline-block text-indigo-800 font-bold hover:underline px-4 py-3">
                Close
            </a>
        </x-modal>
    </div>
</div>
