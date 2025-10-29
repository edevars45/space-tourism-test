<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Je centre mon contenu et je gère les paddings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Mon logo pointe vers le dashboard -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Liens de navigation (desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Liens publics --}}
                    <x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                        Accueil
                    </x-nav-link>
                    <x-nav-link :href="route('destination')" :active="request()->routeIs('destination')">
                        Destination
                    </x-nav-link>
                    <x-nav-link :href="route('equipage')" :active="request()->routeIs('equipage')">
                        Équipage
                    </x-nav-link>
                    <x-nav-link :href="route('technologie')" :active="request()->routeIs('technologie')">
                        Technologie
                    </x-nav-link>

                    {{-- Dashboard (toujours visible une fois connecté, sinon il redirigera vers login si protégé) --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    {{-- Back-office admin (je le montre seulement si j'ai le rôle admin) --}}
                    @role('admin')
                        {{-- Spatie --}}
                        <x-nav-link :href="route('admin.planets.index')" :active="request()->routeIs('admin.planets.*')">
                            Gestion des planètes
                        </x-nav-link>
                    @endrole
                    {{-- Si tu préfères la Gate : remets @can('admin') ... @endcan à la place --}}
                </div>
            </div>

            <!-- Zone à droite (nom utilisateur + menu) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Si je suis connecté, j'affiche mon nom + badge Admin (si j'ai le rôle) -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center gap-2">
                                    <span>{{ Auth::user()->name }}</span>
                                    @role('admin')
                                        <span class="text-xs px-2 py-0.5 rounded bg-gray-200">Admin</span>
                                    @endrole
                                </div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Déconnexion -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <!-- Si je ne suis pas connecté, je propose Login -->
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Se connecter
                    </a>
                @endguest
            </div>

            <!-- Menu mobile (hamburger) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    aria-label="Ouvrir le menu">
                    <!-- Icône burger -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu responsive (mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                Accueil
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('destination')" :active="request()->routeIs('destination')">
                Destination
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('equipage')" :active="request()->routeIs('equipage')">
                Équipage
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('technologie')" :active="request()->routeIs('technologie')">
                Technologie
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @role('admin')
                <x-responsive-nav-link :href="route('admin.planets.index')" :active="request()->routeIs('admin.planets.*')">
                    Gestion des planètes
                </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Zone profil (mobile) -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    @role('admin')
                        <div class="text-sm text-gray-500">Admin</div>
                    @endrole
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Se connecter
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        S'inscrire
                    </a>
                @endif
            </div>
        @endguest
    </div>
</nav>
