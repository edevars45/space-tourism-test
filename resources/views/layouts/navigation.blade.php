{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open:false }" class="bg-white border-b border-gray-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            {{-- Gauche : Logo + liens principaux --}}
            <div class="flex">
                <a href="{{ route('accueil') }}" class="flex items-center">
                    <x-application-logo class="h-8 w-8 text-gray-700" />
                </a>

                <div class="hidden sm:-my-px sm:ml-8 sm:flex sm:space-x-6">
                    <a href="{{ route('accueil') }}"
                       class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                              {{ request()->routeIs('accueil') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Accueil
                    </a>
                    <a href="{{ route('destination') }}"
                       class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                              {{ request()->routeIs('destination') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Destination
                    </a>
                    <a href="{{ route('equipage') }}"
                       class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                              {{ request()->routeIs('equipage') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Équipage
                    </a>
                    <a href="{{ route('technologie') }}"
                       class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                              {{ request()->routeIs('technologie') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Technologie
                    </a>

                    @auth
                        {{-- Liens admin : Dashboard + Gestion --}}
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                                  {{ request()->routeIs('dashboard') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.planets.index') }}"
                           class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                                  {{ request()->is('admin/planets*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Gestion des planètes
                        </a>
                        <a href="{{ route('admin.crew.index') }}"
                           class="inline-flex items-center border-b-2 px-1 pt-1 text-sm
                                  {{ request()->is('admin/crew*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Gestion de l’équipage
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Droite : Auth --}}
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="mr-4 rounded-md border px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Se connecter
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="rounded-md bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700">
                            S’inscrire
                        </a>
                    @endif
                @endguest

                @auth
                    {{-- Menu utilisateur (Alpine) --}}
                    <div x-data="{ open:false }" class="relative">
                        <button @click="open = !open"
                                class="inline-flex items-center rounded-md border px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 focus:outline-none">
                            {{ Auth::user()->name ?? 'Utilisateur' }}
                            <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="open" @click.away="open = false"
                             class="absolute right-0 z-50 mt-2 w-48 rounded-md bg-white shadow ring-1 ring-black/5">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    Mon profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        Se déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Burger mobile --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu mobile (optionnel) --}}
    <div x-show="open" class="sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <a href="{{ route('accueil') }}" class="block px-4 py-2 text-gray-700">Accueil</a>
            <a href="{{ route('destination') }}" class="block px-4 py-2 text-gray-700">Destination</a>
            <a href="{{ route('equipage') }}" class="block px-4 py-2 text-gray-700">Équipage</a>
            <a href="{{ route('technologie') }}" class="block px-4 py-2 text-gray-700">Technologie</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700">Dashboard</a>
                <a href="{{ route('admin.planets.index') }}" class="block px-4 py-2 text-gray-700">Gestion des planètes</a>
                <a href="{{ route('admin.crew.index') }}" class="block px-4 py-2 text-gray-700">Gestion de l’équipage</a>
            @endauth
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            @auth
                <div class="px-4 text-sm text-gray-700">{{ Auth::user()->name }}</div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700">Mon profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="block w-full text-left px-4 py-2 text-gray-700">Se déconnecter</button>
                    </form>
                </div>
            @else
                <div class="px-4 py-2">
                    <a href="{{ route('login') }}" class="mr-3 rounded-md border px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Se connecter</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700">S’inscrire</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
