{{-- resources/views/components/header.blade.php --}}
<header role="banner" class="absolute top-0 left-0 w-full flex items-center justify-between px-6 py-4 z-50">

    <a href="{{ route('accueil') }}">
        <img src="{{ asset('/images/logo.png') }}" alt="TP Space tourisme" class="h-10 w-auto">
    </a>


    <nav role="navigation" aria-label="Menu principal"
        class="hidden sm:flex items-center gap-12 bg-white/5 backdrop-blur-lg px-12 py-4
            uppercase text-white tracking-[0.25em] text-sm font-light">


        {{-- Accueil --}}
        <a href="{{ route('accueil') }}"
            class="'border-b-2 border-white pb-1 font-normal' : 'opacity-70 hover:opacity-100' }}">
            <span class="font-bold mr-2">00 Accueil</span>
        </a>

        {{-- Destination --}}
        <a href="{{ route('destination') }}"
            class=" 'border-b-2 border-white pb-1 font-normal' : 'opacity-70 hover:opacity-100' }}">
            <span class="font-bold mr-2">01 Destination</span>
        </a>

        {{-- Équipage --}}
        <a href="{{ route('equipage') }}"
            class=" 'border-b-2 border-white pb-1 font-normal' : 'opacity-70 hover:opacity-100' }}">
            <span class="font-bold mr-2">02 Equipage</span>
        </a>

        {{-- Technologie --}}
        <a href="{{ route('technologie') }}"
            class=" 'border-b-2 border-white pb-1 font-normal' : 'opacity-70 hover:opacity-100' }}">
            <span class="font-bold mr-2">03 Technologie</span>
        </a>
        <div class="flex gap-4 text-white">
            <a href="{{ url('lang/fr') }}" class="{{ app()->getLocale() === 'fr' ? 'font-bold underline' : '' }}">
                FR
            </a>

            <a href="{{ url('lang/en') }}" class="{{ app()->getLocale() === 'en' ? 'font-bold underline' : '' }}">
                EN
            </a>
        </div>
    </nav>



    <button id="menu-btn" aria-label="Ouvrir le menu mobile" aria-expanded="false"
        class="md:hidden text-white text-3xl">☰</button>
</header>


<nav id="mobile-menu" role="navigation" aria-label="Menu mobile"
    class="hidden fixed top-0 right-0 w-1/2 h-full bg-black/80 backdrop-blur-lg
            text-white p-8 flex-col gap-8 uppercase tracking-[0.25em] text-base font-light z-50">

    {{-- Bouton fermer --}}
    <button id="close-btn" aria-label="Fermer le menu mobile" class="self-end text-3xl mb-12">✖</button>
</nav>

{{-- ============================ --}}
{{-- SCRIPT DU MENU BURGER --}}
{{-- ============================ --}}
<script>
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    // Ouvrir le menu
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        mobileMenu.classList.add('flex'); // affichage flex en colonne
        mobileMenu.classList.add('flex-col');
        menuBtn.setAttribute('aria-expanded', 'true');
    });

    // Fermer le menu
    closeBtn.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('flex');
        mobileMenu.classList.remove('flex-col');
        menuBtn.setAttribute('aria-expanded', 'false');
    });
</script>
