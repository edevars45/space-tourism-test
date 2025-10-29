{{-- resources/views/components/layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Space Tourism') }}</title>

    {{-- Polices --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bellefair&family=DynaPuff:wght@400..700&family=Rouge+Script&display=swap"
        rel="stylesheet">

    {{-- Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative text-white">

    {{-- Fond via slot nommé `bgImage` (facultatif) --}}
    @isset($bgImage)
        @php $bg = trim((string) $bgImage); @endphp
        @if($bg !== '')
            <div
                class="absolute inset-0 -z-10 bg-cover bg-center"
                style="background-image: url('{{ $bg }}')">
            </div>
        @endif
    @endisset

    {{-- Header global (menu public + dropdown auth/admin) --}}
    <x-header />

    {{-- Contenu page.
         pt-24 évite que le contenu passe sous le header (header en absolute). --}}
    <main class="pt-24">
        {{ $slot }}
    </main>
</body>
</html>
