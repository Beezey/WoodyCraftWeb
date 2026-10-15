@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-cream text-start text-base font-medium text-cream bg-pine-light focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-cream/70 hover:text-cream hover:bg-pine-light hover:border-cream/40 focus:outline-none focus:text-cream focus:bg-pine-light transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
