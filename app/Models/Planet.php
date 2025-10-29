<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','description','distance','duration'];


    // J’autorise l’écriture de masse sur ces champs.
    // protected $fillable = [
    //     'name_fr',
    //     'name_en',
    //     'description_fr',
    //     'description_en',
    //     'image',
    //     'distance',
    //     'duration',
    // ];

    // Si je veux caster certains champs, je le ferai ici.
    // protected $casts = [];
}
