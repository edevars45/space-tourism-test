<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Créer une planète — Admin" }}
        </h2>
    </x-slot>
 
    <section class="max-w-3xl mx-auto px-6 py-8">
        {{-- Titre + retour --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Créer une planète</h1>
            <a href="{{ route('admin.planets.index') }}" class="underline">Retour à la liste</a>
        </div>
 
        {{-- Erreurs globales --}}
        @if($errors->any())
            <div class="mb-4 rounded border border-red-500/40 bg-red-500/10 text-red-200 px-4 py-3">
                <p class="font-medium mb-1">Merci de corriger les erreurs ci-dessous :</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        <form action="{{ route('admin.planets.store') }}" method="POST" class="space-y-6">
            @csrf
 
            {{-- Nom --}}
            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nom</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Ex : Europa"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Slug
            <div>
                <label for="slug" class="block text-sm font-medium mb-1">Slug</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug') }}"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="ex : europa"
                    required
                >
                @error('slug')
                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-400">Minuscules, tirets. Doit être unique.</p>
            </div> --}}
 
            {{-- Actif --}}
            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', true))  {{-- par défaut : actif --}}
                    class="h-4 w-4"
                >
                <label for="is_active" class="text-sm">Activer la planète</label>
            </div>
            @error('is_active')
                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
            @enderror
 
            {{-- Ordre --}}
            <div>
                <label for="order" class="block text-sm font-medium mb-1">Ordre (optionnel)</label>
                <input
                    type="number"
                    id="order"
                    name="order"
                    value="{{ old('order') }}"
                    min="0"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Ex : 1"
                >
                @error('order')
                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium mb-1">Description (optionnel)</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="w-full rounded border border-white/10 bg-white/5 px-3 py-2"
                    placeholder="Texte de présentation..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.planets.index') }}" class="px-4 py-2 rounded bg-white/10 hover:bg-white/20">Annuler</a>
                <button type="submit" class="px-4 py-2 rounded bg-white text-black hover:bg-gray-200">
                    Créer
                </button>
            </div>
        </form>
    </section>
 
</x-app-layout>
 
 