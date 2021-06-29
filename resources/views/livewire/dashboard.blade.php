<div>
    <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4">
        <div class="col md:col-span-2 lg:col-span-3">
            <div class="p-3 bg-white shadow rounded flex flex-col md:py-4 md:px-6">
                <p class="text-xl font-bold">Welcome back {{ $user->name }}!</p>
                <hr class="my-3" />
                <p class="italic font-md">What would you like to do?</p>
                <p class="mt-5">
                    <a href="{{route('post-edit')}}" class="mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                        Create Post
                    </a>
                    <a href="{{route('author-posts', ['user_id' => $user->id])}}" class="mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                        View Your Posts
                    </a>
                    <a href="{{route('profile', ['user_id' => $user->id])}}" class="mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                        View Your Profile
                    </a>
                    <a href="{{route('collections', ['user_id' => $user->id])}}" class="mt-2 inline-block bg-indigo-800 hover:bg-transparent text-white hover:text-indigo-800 font-bold px-4 py-3 border border-indigo-800">
                        View Your Collections
                    </a>
                </p>
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
