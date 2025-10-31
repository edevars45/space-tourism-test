{{-- Formulaire Création/Édition Membre d’équipage
     - Accepte $crew (recommandé) ou $member (fallback si ancien code)
     - Si le modèle existe => mode édition (PUT), sinon => création (POST)
     - Champs JSON : name[fr|en], role_title[fr|en], bio[fr|en]
     - Image requise uniquement en création
--}}

@php
    // 1) Normaliser la variable : on travaille avec $crew dans le partial
    /** @var \App\Models\CrewMember|null $crew */
    $crew = $crew ?? ($member ?? null);

    // 2) Déterminer le mode (create/edit) à partir de l’existence du modèle
    $isEdit = filled($crew) && $crew->exists;

    // 3) Uniformiser l’accès à l’image (selon que tu stockes image_path ou image)
    $currentImage = $crew->image_path ?? $crew->image ?? null;
@endphp

<form method="POST"
      enctype="multipart/form-data"
      action="{{ $isEdit ? route('admin.crew.update', $crew) : route('admin.crew.store') }}">
    @csrf
    @if($isEdit)
        @method('PUT') {{-- Spoof HTTP PUT en édition --}}
    @endif

    {{-- ===========================
         SLUG (clé lisible/URL)
         - Requis
         - old() prioritaire en cas d’erreur de validation
       =========================== --}}
    <div class="mb-4">
        <label class="block font-semibold">Slug *</label>
        <input type="text" name="slug" class="input w-full"
               value="{{ old('slug', $crew->slug ?? '') }}" required>
        @error('slug')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- ===========================
         NOM (JSON FR/EN)
         - name[fr], name[en]
         - Requis
       =========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold">Nom (FR) *</label>
            <input type="text" name="name[fr]" class="input w-full"
                   value="{{ old('name.fr', data_get($crew->name ?? [], 'fr')) }}" required>
            @error('name.fr')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block font-semibold">Name (EN) *</label>
            <input type="text" name="name[en]" class="input w-full"
                   value="{{ old('name.en', data_get($crew->name ?? [], 'en')) }}" required>
            @error('name.en')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- ===========================
         INTITULÉ DE RÔLE (JSON FR/EN)
         - role_title[fr], role_title[en]
         - Requis
       =========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block font-semibold">Rôle (FR) *</label>
            <input type="text" name="role_title[fr]" class="input w-full"
                   value="{{ old('role_title.fr', data_get($crew->role_title ?? [], 'fr')) }}" required>
            @error('role_title.fr')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block font-semibold">Role (EN) *</label>
            <input type="text" name="role_title[en]" class="input w-full"
                   value="{{ old('role_title.en', data_get($crew->role_title ?? [], 'en')) }}" required>
            @error('role_title.en')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- ===========================
         BIOGRAPHIE (JSON FR/EN)
         - bio[fr], bio[en]
         - Optionnel
       =========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block font-semibold">Bio (FR)</label>
            <textarea name="bio[fr]" rows="5" class="input w-full">{{ old('bio.fr', data_get($crew->bio ?? [], 'fr')) }}</textarea>
            @error('bio.fr')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block font-semibold">Bio (EN)</label>
            <textarea name="bio[en]" rows="5" class="input w-full">{{ old('bio.en', data_get($crew->bio ?? [], 'en')) }}</textarea>
            @error('bio.en')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- ===========================
         IMAGE (upload)
         - Requise en création ; optionnelle en édition
         - Prévisualisation si déjà présente
       =========================== --}}
    <div class="mt-4">
        <label class="block font-semibold">Photo {{ $isEdit ? '(optionnel)' : '*' }}</label>

        @if($currentImage)
            <img src="{{ asset('storage/'.$currentImage) }}" alt="Photo actuelle"
                 class="h-20 w-20 object-cover rounded mb-2">
        @endif

        <input type="file" name="image" accept="image/*"
               @if(!$isEdit) required @endif>
        @error('image')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- ===========================
         BOUTON D’ACTION
       =========================== --}}
    <div class="mt-6">
        <x-primary-button>
            {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
        </x-primary-button>
    </div>
</form>
