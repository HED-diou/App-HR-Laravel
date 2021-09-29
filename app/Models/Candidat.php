<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    public $searchTerm;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nom',
        'Prenom',
        'Sexe',
        'CIN',
        'DateNaissance',
        'StatutFamiliale',
        'Ville',
        'Adresse',
        'phone',
        'email',
        'NombreDanneesDexperience',
        'PretentionSalariale',
        'Travailleactuellement',
        'EnArretDepuis',
        'CV',
        'LettreMotivation',
        'DateCandidature',
        'Appreciation',
        'motife',
    ];
}
