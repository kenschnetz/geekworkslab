<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600"/>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-dropdown align="left" width="60">
                        <x-slot name="trigger">
                            <x-nav-link style="height: 66px;" class="cursor-pointer">
                                {{ __('Categories') }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </x-nav-link>
                        </x-slot>
                        <x-slot name="content">
                            <div class="w-60">
                                <x-dropdown-link href="{{ route('category', ['category_slug' => 'items']) }}">
                                    {{ __('Items') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('category', ['category_slug' => 'monsters']) }}">
                                    {{ __('Monsters') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('category', ['category_slug' => 'hooks']) }}">
                                    {{ __('Hooks') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('category', ['category_slug' => 'abilities']) }}">
                                    {{ __('Abilities') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('category', ['category_slug' => 'misc']) }}">
                                    {{ __('Misc') }}
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('forum')" :active="request()->routeIs('forum')">
                            {{ __('Forum') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('account')">
                                {{ __('Account') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-label class="text-xl px-4">
                {{ __('Categories') }}
            </x-label>
            <x-dropdown-link href="{{ route('category', ['category_slug' => 'items']) }}">
                {{ __('Items') }}
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('category', ['category_slug' => 'monsters']) }}">
                {{ __('Monsters') }}
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('category', ['category_slug' => 'hooks']) }}">
                {{ __('Hooks') }}
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('category', ['category_slug' => 'abilities']) }}">
                {{ __('Abilities') }}
            </x-dropdown-link>
            <x-dropdown-link href="{{ route('category', ['category_slug' => 'misc']) }}">
                {{ __('Misc') }}
            </x-dropdown-link>
            @auth
                <hr/>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Forum') }}
                </x-responsive-nav-link>
            @endauth
        </div>
    @auth
        <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-dropdown-link :href="route('profile')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('account')">
                        {{ __('Account') }}
                    </x-dropdown-link>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
