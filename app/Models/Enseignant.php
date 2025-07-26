<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email'];

    // Relation classique (si un enseignant "possède" plusieurs matières directement)
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    // Relation "many-to-many" via la table pivot 'affectations' pour récupérer les classes associées à l'enseignant
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'affectations')
                    ->withPivot('matiere_id')
                    ->withTimestamps();
    }

    // Relation "many-to-many" via la table pivot 'affectations' pour récupérer les matières associées à l'enseignant
    public function matieresAffectees()
    {
        return $this->belongsToMany(Matiere::class, 'affectations')
                    ->withPivot('classe_id')
                    ->withTimestamps();
    }
    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }
}
