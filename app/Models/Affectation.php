<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    // Le nom de la table si différent du pluriel du modèle
    protected $table = 'affectations'; // (facultatif car Laravel déduit automatiquement)


    // Champs autorisés à la création / mise à jour
    protected $fillable = [
        'enseignant_id',
        'matiere_id',
        'classe_id',
    ];

    /**
     * Relation vers l'enseignant.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Relation vers la matière.
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Relation vers la classe.
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
