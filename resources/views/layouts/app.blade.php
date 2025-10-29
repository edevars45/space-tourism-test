<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        {{-- Fonts (tu peux garder bunny.net ou mettre tes propres fonts plus tard) --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Vite (Breeze) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- Barre de navigation Breeze --}}
            @include('layouts.navigation')

            {{-- En-tête optionnel (utilisé par les vues qui définissent $header) --}}
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Contenu principal : priorité au $slot (components), fallback sur @yield --}}
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </body>
</html>
