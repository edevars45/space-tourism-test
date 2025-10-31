<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrewMemberRequest extends FormRequest
{
    /**
     * Autorisation : on laisse à true car l'accès est déjà protégé
     * par les middlewares (auth/role/permissions) dans les routes.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     * - Le paramètre {crew} (model binding) est utilisé pour ignorer le slug courant en édition.
     * - L'image est "required" uniquement en création (POST), sinon "nullable" en update.
     */
    public function rules(): array
    {
        // Récupère l'ID du membre en cours (si édition), sinon null (création)
        $crewId = $this->route('crew')?->id;

        // Règle unique sur le slug :
        //  - table: crew_members
        //  - colonne: slug
        //  - ignore l'ID courant en édition
        $uniqueSlug = Rule::unique('crew_members', 'slug')->ignore($crewId);

        // Image : required en POST (store), nullable en PUT/PATCH (update)
        $imageRule = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            // SLUG lisible d'URL
            'slug'            => ['required', 'alpha_dash', 'max:150', $uniqueSlug],

            // CHAMPS JSON FR/EN
            'name.fr'         => ['required', 'string', 'max:150'],
            'name.en'         => ['required', 'string', 'max:150'],

            'role_title.fr'   => ['required', 'string', 'max:150'],
            'role_title.en'   => ['required', 'string', 'max:150'],

            'bio.fr'          => ['nullable', 'string'],
            'bio.en'          => ['nullable', 'string'],

            // IMAGE (upload)
            // - required en création
            // - formats autorisés + taille max
            'image'           => [$imageRule, 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            // Optionnel : ajouter des contraintes de dimensions
            // 'dimensions:max_width=3000,max_height=3000'
        ];
    }

    /**
     * Messages personnalisés (plus pédagogiques).
     */
    public function messages(): array
    {
        return [
            'slug.required'      => 'Le slug est obligatoire.',
            'slug.alpha_dash'    => 'Le slug ne peut contenir que des lettres, chiffres, tirets et underscores.',
            'slug.max'           => 'Le slug ne doit pas dépasser :max caractères.',
            'slug.unique'        => 'Ce slug est déjà utilisé.',

            'name.fr.required'   => 'Le nom (FR) est obligatoire.',
            'name.en.required'   => 'Le nom (EN) est obligatoire.',
            'role_title.fr.required' => 'Le rôle (FR) est obligatoire.',
            'role_title.en.required' => 'Le rôle (EN) est obligatoire.',

            'image.required'     => 'La photo est obligatoire lors de la création.',
            'image.image'        => 'Le fichier doit être une image.',
            'image.mimes'        => 'Formats autorisés : jpg, jpeg, png, webp.',
            'image.max'          => 'L’image ne doit pas dépasser 2 Mo.',
        ];
    }

    /**
     * Noms “propres” des attributs (affichage des erreurs).
     */
    public function attributes(): array
    {
        return [
            'slug'            => 'slug',
            'name.fr'         => 'nom (FR)',
            'name.en'         => 'nom (EN)',
            'role_title.fr'   => 'rôle (FR)',
            'role_title.en'   => 'rôle (EN)',
            'bio.fr'          => 'bio (FR)',
            'bio.en'          => 'bio (EN)',
            'image'           => 'photo',
        ];
    }

    /**
     * (Optionnel) Préparer/normaliser les données avant validation.
     * Ici, on peut forcer slug en minuscule par exemple.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('slug')) {
            $this->merge([
                'slug' => str()->slug($this->input('slug')), // normalise proprement
            ]);
        }
    }
}
