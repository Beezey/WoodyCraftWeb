<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a computer') }}
        </h2>
    </x-slot>

    <x-computers-card>
        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('computers.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Nom -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input
                    id="name"
                    class="block mt-1 w-full"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                />

                <x-input-error
                    :messages="$errors->get('name')"
                    class="mt-2"
                />
            </div>

            <!-- Catégorie -->
            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />

                <x-text-input
                    id="category"
                    class="block mt-1 w-full"
                    type="text"
                    name="category"
                    :value="old('category')"
                    required
                />

                <x-input-error
                    :messages="$errors->get('category')"
                    class="mt-2"
                />
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
                >{{ old('description') }}</textarea>

                <x-input-error
                    :messages="$errors->get('description')"
                    class="mt-2"
                />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />

                <input
                    id="image"
                    type="file"
                    name="image"
                    class="block mt-1 w-full text-sm text-gray-700 dark:text-gray-300"
                    required
                />

                <x-input-error
                    :messages="$errors->get('image')"
                    class="mt-2"
                />
            </div>

            <!-- Prix -->
            <div class="mt-4">
                <x-input-label for="price" :value="__('Price')" />

                <x-text-input
                    id="price"
                    class="block mt-1 w-full"
                    type="number"
                    step="1"
                    name="price"
                    :value="old('price')"
                    required
                />

                <x-input-error
                    :messages="$errors->get('price')"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>
    </x-computers-card>
</x-app-layout>