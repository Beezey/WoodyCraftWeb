<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panier') }}
        </h2>
    </x-slot>

    <!-- Tableau simple du panier ; la mise en page de la maquette est prévue dans la carte #29 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session()->has('message'))
            <p class="mb-4 text-green-700">{{ session('message') }}</p>
        @endif

        @error('quantity')
            <p class="mb-4 text-red-600">{{ $message }}</p>
        @enderror

        <table class="w-full text-start">
            <thead>
                <tr class="border-b border-bark/20">
                    <th class="py-2 text-start">Ordinateur</th>
                    <th class="py-2 text-right">Prix unitaire</th>
                    <th class="py-2 text-right">Quantité</th>
                    <th class="py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="border-b border-bark/10">
                        <td class="py-2">{{ $item->computer->name }}</td>
                        <td class="py-2 text-right">{{ number_format($item->computer->price, 2, ',', ' ') }} €</td>
                        <td class="py-2 text-right">{{ $item->quantity }}</td>
                        <td class="py-2 text-right">{{ number_format($item->total(), 2, ',', ' ') }} €</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="py-2 text-start" colspan="3">Total du panier</th>
                    <th class="py-2 text-right">{{ number_format($total, 2, ',', ' ') }} €</th>
                </tr>
            </tfoot>
        </table>
    </div>
</x-app-layout>
