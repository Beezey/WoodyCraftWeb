@php
    // Le lien deviendra actif quand la page du panier existera (cartes #12 et #29)
    $cartUrl = Route::has('cart.index') ? route('cart.index') : '#';
@endphp

<nav x-data="{ open: false }" class="bg-pine text-cream">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" class="font-serif text-2xl font-semibold tracking-tight text-cream">
                        WoodyCraft
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('computers.create')" :active="request()->routeIs('computers.create')">
                            {{ __('Create') }}
                        </x-nav-link>

                        <x-nav-link :href="route('computers.index')" :active="request()->routeIs('computers.index')">
                            {{ __('Computers') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-4 sm:ms-6">
                <!-- Lien vers le panier avec le nombre d'articles -->
                <a href="{{ $cartUrl }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-cream hover:bg-pine-light transition" aria-label="Panier, {{ $cartCount }} article(s)">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h2l2.4 11.2a1.5 1.5 0 0 0 1.5 1.2h8.6a1.5 1.5 0 0 0 1.5-1.1L21 8H6.2M9.5 20.5h.01M17.5 20.5h.01" />
                    </svg>
                    Panier
                    <span class="inline-flex items-center justify-center min-w-[1.5rem] h-6 px-1.5 rounded-full bg-cream text-pine text-xs font-bold">{{ $cartCount }}</span>
                </a>

                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-cream/80 hover:text-cream focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-cream text-pine text-sm font-semibold hover:bg-white transition">
                        {{ __('Log in') }}
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center gap-2 sm:hidden">
                <a href="{{ $cartUrl }}" class="inline-flex items-center gap-1 px-2 py-1 text-sm text-cream" aria-label="Panier, {{ $cartCount }} article(s)">
                    Panier
                    <span class="inline-flex items-center justify-center min-w-[1.5rem] h-6 px-1.5 rounded-full bg-cream text-pine text-xs font-bold">{{ $cartCount }}</span>
                </a>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-cream/80 hover:text-cream hover:bg-pine-light focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('computers.index')" :active="request()->routeIs('computers.index')">
                    {{ __('Computers') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('computers.create')" :active="request()->routeIs('computers.create')">
                    {{ __('Create') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-cream/20">
                <div class="px-4">
                    <div class="font-medium text-base text-cream">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-cream/70">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
