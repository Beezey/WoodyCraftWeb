<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer un ordinateur') }}
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
            <!-- Message de réussite -->
            @if (session()->has('message'))
                <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('computers.update', $computer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full"
                        type="text"
                        name="name"
                        :value="old('name', $computer->name)"
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Catégorie -->
                <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Category')" />
                    <select
                        id="category_id"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        name="category_id"
                        required
                    >
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $computer->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea
                        id="description"
                        name="description"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        rows="4"
                        required
                    >{{ old('description', $computer->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Image actuelle -->
                <div class="mt-4">
                    <x-input-label :value="__('Image actuelle')" />
                    <img src="{{ $computer->image }}" alt="{{ $computer->name }}" class="mt-2 max-w-xs rounded-md">
                </div>

                <!-- Nouvelle image (optionnelle) -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Changer l\'image')" />
                    <input
                        id="image"
                        type="file"
                        name="image"
                        class="block mt-1 w-full text-sm text-gray-700 dark:text-gray-300"
                    />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Prix -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input
                        id="price"
                        class="block mt-1 w-full"
                        type="number"
                        step="0.01"
                        name="price"
                        :value="old('price', $computer->price)"
                        required
                    />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Send') }}
                    </x-primary-button>
                </div>
            </form>
        </x-computers-card>
    </div>
</x-app-layout>