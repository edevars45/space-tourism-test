{{-- resources/views/admin/crew/_form.blade.php --}}

@php
    // Toujours travailler avec $crew (fallback sur $member si ancien code)
    /** @var \App\Models\CrewMember|null $crew */
    $crew   = $crew ?? ($member ?? null) ?? new \App\Models\CrewMember();
    $isEdit = $crew->exists;                 // true si édition
@endphp

<form method="POST"
      enctype="multipart/form-data"
      action="{{ $isEdit ? route('admin.crew.update', $crew) : route('admin.crew.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- SLUG (obligatoire) --}}
    <div class="mb-4">
        <label class="block font-semibold">Slug *</label>
        <input type="text" name="slug" class="input w-full"
               value="{{ old('slug', $crew->slug) }}" required>
        @error('slug') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- NOM (JSON FR/EN) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold">Nom (FR) *</label>
            <input type="text" name="name[fr]" class="input w-full"
                   value="{{ old('name.fr', data_get($crew->name, 'fr')) }}" required>
            @error('name.fr') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-semibold">Name (EN) *</label>
            <input type="text" name="name[en]" class="input w-full"
                   value="{{ old('name.en', data_get($crew->name, 'en')) }}" required>
            @error('name.en') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- RÔLE (JSON FR/EN) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block font-semibold">Rôle (FR) *</label>
            <input type="text" name="role_title[fr]" class="input w-full"
                   value="{{ old('role_title.fr', data_get($crew->role_title, 'fr')) }}" required>
            @error('role_title.fr') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-semibold">Role (EN) *</label>
            <input type="text" name="role_title[en]" class="input w-full"
                   value="{{ old('role_title.en', data_get($crew->role_title, 'en')) }}" required>
            @error('role_title.en') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- BIO (JSON FR/EN) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block font-semibold">Bio (FR)</label>
            <textarea name="bio[fr]" rows="5" class="input w-full">{{ old('bio.fr', data_get($crew->bio, 'fr')) }}</textarea>
            @error('bio.fr') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-semibold">Bio (EN)</label>
            <textarea name="bio[en]" rows="5" class="input w-full">{{ old('bio.en', data_get($crew->bio, 'en')) }}</textarea>
            @error('bio.en') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- IMAGE (requise en création, optionnelle en édition) --}}
    <div class="mt-4">
        <label class="block font-semibold">Photo {{ $isEdit ? '(optionnel)' : '*' }}</label>

        @if(!empty($crew->image))
            <img src="{{ asset('storage/'.$crew->image) }}" alt="Photo actuelle"
                 class="h-20 w-20 object-cover rounded mb-2">
        @endif

        <input type="file" name="image" accept="image/*" @unless($isEdit) required @endunless>
        @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- ACTION --}}
    <div class="mt-6">
        <x-primary-button>
            {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
        </x-primary-button>
    </div>
</form>
