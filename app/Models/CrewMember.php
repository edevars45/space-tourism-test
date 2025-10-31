<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrewMember extends Model
{
    use HasFactory, SoftDeletes;// nécessaire pour CrewMember::factory()

    protected $fillable = [
        'slug',
        'name',        // JSON
        'role_title',  // JSON
        'bio',         // JSON
        'image',       // <-- on reste sur "image" (cohérent partout)
    ];

    protected $casts = [
        'name'       => 'array',
        'role_title' => 'array',
        'bio'        => 'array',
    ];

    // (optionnel) URL publique de l'image
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
