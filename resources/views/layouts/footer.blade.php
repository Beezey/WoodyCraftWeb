<footer class="bg-bark text-cream/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-8 sm:grid-cols-3">
        <div>
            <p class="font-serif text-2xl font-semibold text-cream">WoodyCraft</p>
            <p class="mt-2 text-sm">Des ordinateurs choisis avec soin, livrés chez vous.</p>
        </div>

        <div>
            <p class="font-semibold text-cream">Boutique</p>
            <ul class="mt-2 space-y-1 text-sm">
                <li><a href="{{ route('computers.index') }}" class="hover:text-cream">{{ __('Computers') }}</a></li>
                <li><a href="{{ Route::has('cart.index') ? route('cart.index') : '#' }}" class="hover:text-cream">Panier</a></li>
            </ul>
        </div>

        <div>
            <p class="font-semibold text-cream">Mon compte</p>
            <ul class="mt-2 space-y-1 text-sm">
                @auth
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-cream">{{ __('Profile') }}</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-cream">{{ __('Log in') }}</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-cream">{{ __('Register') }}</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <div class="border-t border-cream/10">
        <p class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-xs text-cream/60">
            © {{ date('Y') }} WoodyCraft — projet BTS SIO SLAM
        </p>
    </div>
</footer>
