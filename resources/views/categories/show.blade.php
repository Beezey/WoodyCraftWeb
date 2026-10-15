<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <!-- Liste simple des ordinateurs ; la mise en page de la maquette est prévue dans la carte #26 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <ul class="list-disc ps-6 space-y-1">
            @foreach ($computers as $computer)
                <li>{{ $computer->name }} — {{ number_format($computer->price, 2, ',', ' ') }} €</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
