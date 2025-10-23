<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellefair:ital,wght@0,400;1,400&family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Vite assets (Breeze) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">

    {{-- NAVBAR SIMPLE --}}
    <nav class="border-b">
        <div class="mx-auto max-w-7xl px-4 py-3 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="font-semibold">Dashboard</a>

            @auth
                @can('admin')
                    <a href="{{ route('admin.planets.index') }}">Gestion des planètes</a>
                @endcan

                <span class="ml-auto text-sm opacity-70">
                    Connecté : {{ auth()->user()->name }} (rôle: {{ auth()->user()->role ?? 'user' }})
                </span>
            @endauth
        </div>
    </nav>

    {{-- Wrapper principal --}}
    <div class="min-h-screen">
        @isset($header)
            <header class="border-b">
                <div class="mx-auto max-w-7xl px-4 py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="mx-auto max-w-7xl px-4 py-6">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>
</body>
</html>
