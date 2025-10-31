<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrewMemberRequest extends FormRequest
{
    /**
     * Autorisation : true, car l'accès est déjà protégé par les middlewares
     * (auth/role/permissions) sur les routes admin.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     * - {crew} (model binding) permet d'ignorer le slug courant en édition.
     * - L'image est "required" en création (POST), "nullable" en update (PUT/PATCH).
     */
    public function rules(): array
    {
        $crewId = $this->route('crew')?->id;

        $uniqueSlug = Rule::unique('crew_members', 'slug')->ignore($crewId);
        $imageRule  = $this->isMethod('post') ? 'required' : 'nullable';

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
            'image'           => [$imageRule, 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            // (option) 'dimensions:max_width=3000,max_height=3000',
        ];
    }

    /**
     * Messages d'erreurs personnalisés.
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
     * Noms “propres” des attributs.
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
     * Pré-normalisation des données AVANT validation.
     * Objectif : rendre le formulaire rétro-compatible avec un format simple
     * (name/role/bio en string) et garantir un slug valide si absent.
     */
    protected function prepareForValidation(): void
    {
        $data = $this->all();

        // 1) Normaliser NAME : si "name" est une string -> JSON [fr,en]
        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = [
                'fr' => $data['name'],
                'en' => $data['name'],
            ];
        }

        // 2) Normaliser ROLE : si "role" est une string -> role_title[fr|en]
        if (isset($data['role']) && is_string($data['role'])) {
            $data['role_title'] = [
                'fr' => $data['role'],
                'en' => $data['role'],
            ];
            unset($data['role']); // éviter conflit avec rules
        }

        // 3) Normaliser BIO : si "bio" est une string -> JSON [fr,en]
        if (isset($data['bio']) && is_string($data['bio'])) {
            $data['bio'] = [
                'fr' => $data['bio'],
                'en' => $data['bio'],
            ];
        }

        // 4) Générer SLUG si absent (priorité au name.fr puis name.en)
        if (blank($data['slug'] ?? null)) {
            $base = data_get($data, 'name.fr') ?? data_get($data, 'name.en') ?? null;
            if ($base) {
                $data['slug'] = str()->slug($base);
            }
        }

        // 5) Slug toujours “slugifié” si fourni
        if (filled($data['slug'] ?? null)) {
            $data['slug'] = str()->slug($data['slug']);
        }

        $this->replace($data);
    }
}
