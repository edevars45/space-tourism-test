{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name','Laravel') }}</title>

    {{-- Vite : charge le CSS et le JS (Alpine inclus via app.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation') {{-- la barre du haut --}}

        @isset($header)
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="py-6">
            {{ $slot ?? '' }} {{-- pour les composants --}}
            @yield('content') {{-- pour les vues "classiques" --}}
        </main>
    </div>
</body>
</html>
