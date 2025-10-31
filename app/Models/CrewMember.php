<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
        protected $fillable = [
        'slug',
        'name',
        'role_title',
        'bio',
        'image',
    ];

    protected $casts = [
        'name'       => 'array',
        'role_title' => 'array',
        'bio'        => 'array',
    ];
}
