<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accueil') }}
        </h2>
    </x-slot>

    <!-- Liste simple des catégories ; la mise en page de la maquette est prévue dans la carte #25 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h3 class="text-lg font-semibold mb-4">Toutes les catégories</h3>

        <ul class="list-disc ps-6 space-y-1">
            @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
