<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanetRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name_fr'        => ['required','string','max:255'],
            'name_en'        => ['required','string','max:255'],
            'description_fr' => ['required','string'],
            'description_en' => ['required','string'],
            'distance'       => ['required','string','max:255'],
            'duration'       => ['required','string','max:255'],
            'image'          => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
