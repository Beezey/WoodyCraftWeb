<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Afficher un ordinateur')
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-6">

        <!-- Flèche de retour -->
        <a href="{{ route('computers.index') }}"
           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            @lang('Retour')
        </a>

        <x-computers-card>
            <h3 class="font-semibold text-xl text-gray-800">@lang('Nom')</h3>
            <p>{{ $computer->name }}</p>

            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Catégorie')</h3>
            <p>{{ $computer->category }}</p>

            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Description')</h3>
            <p>{{ $computer->description }}</p>

            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Prix')</h3>
            <p>{{ $computer->price }} €</p>

            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Image')</h3>
            <img src="{{ $computer->image }}"
                 alt="{{ $computer->name }}"
                 class="mt-2 w-full max-w-sm h-64 object-cover rounded-md shadow">

            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Date création')</h3>
            <p>{{ $computer->created_at->format('d/m/Y') }}</p>

            @if ($computer->created_at != $computer->updated_at)
                <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Last update')</h3>
                <p>{{ $computer->updated_at->format('d/m/Y') }}</p>
            @endif
        </x-computers-card>
    </div>
</x-app-layout>