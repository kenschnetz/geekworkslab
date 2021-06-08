<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Submissions') }}
        </h2>
    </x-slot>
    <div class="relative">
        <div class="relative max-w-4xl mx-auto">
            <div class="mt-12 max-w-lg mx-auto lg:max-w-none">
                <div class="rounded-lg shadow-lg overflow-hidden grid lg:grid-cols-2">
                    <div class="flex flex-col">
                        <img class="w-full object-cover" src="/storage/post-images/amulet-of-awesomeness.jpeg" style="min-width: 100%; min-height: 100%;">
                    </div>
                    <div class="bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="#" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">
                                    <u>Amulet Of Awesomeness</u>
                                </p>
                            </a>
                            <p class="text-sm font-medium text-gray-900">
                                <i>Version: 3</i>
                            </p>
                            <p class="mt-3 text-base text-gray-500">
                                Your Constitution score is 19 while you wear this amulet. It has no effect on you if
                                your Constitution is already 19 or higher without it.
                            </p>
                            <p class="mt-3 text-base text-gray-500">
                                <strong>Item type:</strong> Jewelry<br/>
                                <strong>Modifies:</strong> Constitution<br/>
                                <strong>Rarity:</strong> Wondrous Item, Rare (requires attunement)<br/>
                                <strong>Requires attunement:</strong> Yes
                            </p>
                            <hr class="mt-3 mb-3"/>
                            <p class="mt-3 text-base text-gray-500">
                                <strong>Author: </strong>
                                <a href="#" class="hover:underline">
                                    <u>Ken Schnetz</u>
                                </a><br/>
                                <strong>Rating: </strong>4<br/>
                                <strong>Category: </strong><u>Item</u><br/>
                                <strong>Tags: </strong><u>Jewelry</u>, <u>Attuned</u>, <u>Rare</u>, <u>Constitution</u><br/>
                                <strong><u>21 Comments</u></strong>
                            </p>
                            <hr class="mt-3 mb-3"/>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                <button type="button" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    Branch
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    Recommend
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    Comment
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    Save
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    Share
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
