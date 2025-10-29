{{-- resources/views/components/header.blade.php --}}
@php
    // petites fonctions utilitaires pour les classes actives
    $isActive = fn(string $name) => request()->routeIs($name) ? 'opacity-100 border-b-2 border-white' : 'opacity-70 hover:opacity-100';
    $isActiveStarts = fn(string $pattern) => request()->routeIs($pattern) ? 'opacity-100 border-b-2 border-white' : 'opacity-70 hover:opacity-100';
@endphp

<header role="banner" class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        {{-- Logo --}}
        <a href="{{ route('accueil') }}" aria-label="Aller à l’accueil">
            <img src="{{ asset('/images/logo.png') }}" alt="TP Space Tourisme" class="h-10 w-auto">
        </a>

        {{-- Desktop nav --}}
        <nav role="navigation" aria-label="Menu principal"
             class="hidden md:flex items-center gap-10 bg-white/5 backdrop-blur-lg px-10 py-3
                    uppercase text-white tracking-[0.25em] text-sm font-light rounded-full">

            <a href="{{ route('accueil') }}" class="{{ $isActive('accueil') }}">
                <span class="font-bold mr-2">00</span> Accueil
            </a>

            <a href="{{ route('destination') }}" class="{{ $isActive('destination') }}">
                <span class="font-bold mr-2">01</span> Destination
            </a>

            <a href="{{ route('equipage') }}" class="{{ $isActive('equipage') }}">
                <span class="font-bold mr-2">02</span> Équipage
            </a>

            <a href="{{ route('technologie') }}" class="{{ $isActive('technologie') }}">
                <span class="font-bold mr-2">03</span> Technologie
            </a>

            {{-- Lien admin (Spatie) --}}
            @auth
                @role('admin')
                    <a href="{{ route('admin.planets.index') }}" class="{{ $isActiveStarts('admin.planets.*') }}">
                        <span class="font-bold mr-2">04</span> Gestion des planètes
                    </a>
                @endrole
            @endauth

            {{-- Switch langue --}}
            <div class="flex gap-3 items-center ml-2">
                <a href="{{ url('lang/fr') }}" class="hover:underline {{ app()->getLocale()==='fr' ? 'font-bold underline' : '' }}">FR</a>
                <span aria-hidden="true" class="opacity-40">|</span>
                <a href="{{ url('lang/en') }}" class="hover:underline {{ app()->getLocale()==='en' ? 'font-bold underline' : '' }}">EN</a>
            </div>

            {{-- Zone Auth --}}
            <div class="ml-4">
                @guest
                    <a href="{{ route('login') }}" class="opacity-70 hover:opacity-100">Login</a>
                    <span aria-hidden="true" class="opacity-40">/</span>
                    <a href="{{ route('register') }}" class="opacity-70 hover:opacity-100">Register</a>
                @else
                    <div class="relative group">
                        <button class="opacity-90 hover:opacity-100">
                            {{ Auth::user()->name }}
                            <span aria-hidden="true" class="ml-1">▾</span>
                        </button>

                        <div class="hidden group-hover:block absolute right-0 mt-2 w-40 bg-white/95 text-gray-800 rounded shadow-lg p-2">
                            <a class="block px-3 py-2 hover:bg-gray-100 rounded" href="{{ route('profile.edit') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>

        {{-- Bouton menu mobile --}}
        <button id="menu-btn" aria-label="Ouvrir le menu mobile" aria-expanded="false"
                class="md:hidden text-white text-3xl">☰</button>
    </div>

    {{-- Menu mobile en slide depuis la droite --}}
    <nav id="mobile-menu" role="navigation" aria-label="Menu mobile"
         class="hidden fixed top-0 right-0 w-4/5 max-w-xs h-full bg-black/80 backdrop-blur-lg
                text-white p-8 flex-col gap-6 uppercase tracking-[0.25em] text-base font-light">

        <button id="close-btn" aria-label="Fermer le menu mobile" class="self-end text-3xl mb-6">✖</button>

        <a href="{{ route('accueil') }}" class="{{ $isActive('accueil') }}">00 Accueil</a>
        <a href="{{ route('destination') }}" class="{{ $isActive('destination') }}">01 Destination</a>
        <a href="{{ route('equipage') }}" class="{{ $isActive('equipage') }}">02 Équipage</a>
        <a href="{{ route('technologie') }}" class="{{ $isActive('technologie') }}">03 Technologie</a>

        @auth
            @role('admin')
                <a href="{{ route('admin.planets.index') }}" class="{{ $isActiveStarts('admin.planets.*') }}">04 Gestion des planètes</a>
            @endrole
        @endauth

        <div class="flex gap-3 items-center pt-2">
            <a href="{{ url('lang/fr') }}" class="{{ app()->getLocale()==='fr' ? 'font-bold underline' : '' }}">FR</a>
            <span aria-hidden="true" class="opacity-40">|</span>
            <a href="{{ url('lang/en') }}" class="{{ app()->getLocale()==='en' ? 'font-bold underline' : '' }}">EN</a>
        </div>

        <div class="pt-4 border-t border-white/20">
            @guest
                <a href="{{ route('login') }}" class="block">Login</a>
                <a href="{{ route('register') }}" class="block mt-2">Register</a>
            @else
                <a href="{{ route('profile.edit') }}" class="block">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button class="w-full text-left">Log Out</button>
                </form>
            @endguest
        </div>
    </nav>
</header>

{{-- Script menu burger (vanilla) --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (!menuBtn || !closeBtn || !mobileMenu) return;

        const open = () => {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex','flex-col');
            menuBtn.setAttribute('aria-expanded', 'true');
        };
        const close = () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex','flex-col');
            menuBtn.setAttribute('aria-expanded', 'false');
        };

        menuBtn.addEventListener('click', open);
        closeBtn.addEventListener('click', close);
    });
</script>
