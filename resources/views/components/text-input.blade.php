@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-pine focus:ring-pine rounded-md shadow-sm']) !!}>
