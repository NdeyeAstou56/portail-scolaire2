<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    //protected $fillable = ['nom', 'niveau'];
    protected $fillable = ['nom', 'niveau_id'];


    
    // Relation : une classe a plusieurs élèves
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    // Relation classique (matières "directes" avec classe_id dans matieres)
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    // Relation : une classe appartient à un niveau
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    // Relation many-to-many avec enseignants via la table pivot 'affectations'
    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'affectations')
                    ->withPivot('matiere_id')
                    ->withTimestamps();
    }

    // Relation many-to-many avec matières via la table pivot 'affectations'
    public function matieresAffectees()
    {
        return $this->belongsToMany(Matiere::class, 'affectations')
                    ->withPivot('enseignant_id')
                    ->withTimestamps();
    }
    public function affectations()
{
    return $this->hasMany(Affectation::class);
}

}
