<div>
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
</div>
