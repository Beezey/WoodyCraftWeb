<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Polices de la maquette : Fraunces (titres) et DM Sans (texte) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,700|fraunces:500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-cream text-bark">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <main class="flex-1 flex flex-col items-center px-4 py-12">
                <div class="w-full sm:max-w-md px-6 py-6 bg-white border border-bark/10 shadow-sm overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
