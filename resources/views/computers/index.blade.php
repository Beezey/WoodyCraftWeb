<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Liste des ordinateurs')
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 py-6">

        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mb-6 px-4 py-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <!-- Grille de cartes : 1 colonne sur mobile, 2 sur tablette, 3 sur desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($computers as $computer)
                <div class="relative bg-white rounded-lg shadow hover:shadow-xl transition-transform duration-300 hover:scale-105 overflow-hidden flex flex-col">

                    <!-- Lien invisible qui couvre toute la card et redirige vers Afficher -->
                    <a href="{{ route('computers.show', $computer->id) }}" class="absolute inset-0 z-0" aria-label="{{ __('Afficher') }} {{ $computer->name }}"></a>

                    <!-- Image en grand -->
                    <img src="{{ $computer->image }}"
                         alt="{{ $computer->name }}"
                         class="w-full h-56 object-cover pointer-events-none">

                    <div class="p-4 flex flex-col flex-1">
                        <!-- Nom en dessous -->
                        <h3 class="text-lg font-semibold text-gray-800 text-center mb-4 pointer-events-none">
                            {{ $computer->name }}
                        </h3>

                        <!-- Actions -->
                        <div class="relative z-10 mt-auto flex flex-wrap justify-center gap-2">
                            <a href="{{ route('computers.show', $computer->id) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-gray-800 text-white text-xs font-semibold uppercase tracking-wide rounded-md hover:bg-gray-700 transition">
                                @lang('Afficher')
                            </a>

                            <a href="{{ route('computers.edit', $computer->id) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-gray-800 text-white text-xs font-semibold uppercase tracking-wide rounded-md hover:bg-gray-700 transition">
                                @lang('Éditer')
                            </a>

                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('destroy{{ $computer->id }}').submit();"
                               class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold uppercase tracking-wide rounded-md hover:bg-red-700 transition">
                                @lang('Supprimer')
                            </a>
                            <form id="destroy{{ $computer->id }}"
                                  action="{{ route('computers.destroy', $computer->id) }}"
                                  method="POST"
                                  class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>

                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('duplicate{{ $computer->id }}').submit();"
                               class="inline-flex items-center px-3 py-1.5 bg-gray-800 text-white text-xs font-semibold uppercase tracking-wide rounded-md hover:bg-gray-700 transition">
                                @lang('Dupliquer')
                            </a>
                            <form id="duplicate{{ $computer->id }}"
                                  action="{{ route('computers.duplicate', $computer->id) }}"
                                  method="POST"
                                  class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>