{{-- 
    TP Space Tourism — Partie 04 (Back-office CRUD Planètes)

    Ce que j’ai fait dans les parties précédentes :
    - Partie 01 (Intégration) : 
      J’ai intégré les pages publiques de la maquette avec Blade et Tailwind 
      et j’ai posé les routes publiques (accueil, destination, équipage, technologie).

    - Partie 02 (Internationalisation) :
      J’ai activé l’i18n FR/EN pour le front. 
      Dans le module Planètes, je stocke les libellés multilingues en colonnes (name_fr, name_en)
      pour simplifier le back-office (la consigne précise que l’i18n ne concerne pas le BO).

    - Partie 03 (Tests de routes) :
      J’ai écrit des tests Feature pour vérifier les statuts de toutes les routes publiques 
      dans les deux langues, et j’ai gardé la navigation cohérente.

    - Partie 04 (Back-office Planètes) :
      J’ai créé le CRUD Admin protégé (Spatie rôle "admin"). 
      Ici, je liste les planètes paginées, avec actions Créer / Modifier / Supprimer.
--}}

<x-app-layout>
    {{-- En-tête du layout Breeze : je nomme clairement la section --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planètes — Back-office
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Action primaire : je renvoie sur le formulaire de création --}}
            <a href="{{ route('admin.planets.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Créer une planète
            </a>

            {{-- Carte principale : je présente le tableau des planètes paginées --}}
            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                @if($planets->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    {{-- Je sépare bien les colonnes FR/EN pour le back-office --}}
                                    <th scope="col" class="text-left py-2 px-2">Nom (FR)</th>
                                    <th scope="col" class="text-left py-2 px-2">Nom (EN)</th>
                                    <th scope="col" class="text-left py-2 px-2">Distance</th>
                                    <th scope="col" class="text-left py-2 px-2">Durée</th>
                                    <th scope="col" class="text-left py-2 px-2 w-40">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planets as $planet)
                                    <tr class="border-b">
                                        {{-- Je montre les champs simples du modèle --}}
                                        <td class="py-2 px-2">{{ $planet->name_fr }}</td>
                                        <td class="py-2 px-2">{{ $planet->name_en }}</td>
                                        <td class="py-2 px-2">{{ $planet->distance }}</td>
                                        <td class="py-2 px-2">{{ $planet->duration }}</td>

                                        {{-- Colonne d’actions : 
                                             - Modifier : GET -> admin.planets.edit
                                             - Supprimer : formulaire DELETE -> admin.planets.destroy
                                             Je fais attention à ne pas appeler update en GET. --}}
                                        <td class="py-2 px-2">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.planets.edit', $planet) }}"
                                                   class="text-blue-600 hover:underline">
                                                    Modifier
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('admin.planets.destroy', $planet) }}"
                                                      onsubmit="return confirm('Supprimer cette planète ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:underline">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Laravel : je laisse le composant par défaut Breeze/Tailwind --}}
                    <div class="mt-4">
                        {{ $planets->links() }}
                    </div>
                @else
                    {{-- Cas vide : je donne un message simple et une action pour créer --}}
                    <p class="text-gray-600">Aucune planète pour le moment.</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.planets.create') }}"
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Ajouter la première planète
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
