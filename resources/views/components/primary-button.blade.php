<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-pine border border-transparent rounded-md font-semibold text-xs text-cream uppercase tracking-widest hover:bg-pine-light focus:bg-pine-light active:bg-bark focus:outline-none focus:ring-2 focus:ring-pine focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
