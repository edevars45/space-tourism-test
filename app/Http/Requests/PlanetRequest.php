<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanetRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Les routes sont déjà protégées par auth + can:admin
        return true;
    }

    public function rules(): array
    {
        $planetId = $this->route('planet')?->id;

        return [
            'name'        => ['required','string','max:255','unique:planets,name'.($planetId ? ",$planetId" : '')],
            'description' => ['required','string'],
            'distance'    => ['required','string','max:255'],
            'duration'    => ['required','string','max:255'],
            'image'       => ['nullable','image','max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom est requis.',
            'name.unique'          => 'Ce nom existe déjà.',
            'description.required' => 'La description est requise.',
            'distance.required'    => 'La distance est requise.',
            'duration.required'    => 'La durée est requise.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.max'            => 'Image trop volumineuse (max 2 Mo).',
        ];
    }
}
