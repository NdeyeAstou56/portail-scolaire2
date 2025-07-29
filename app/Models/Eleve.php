<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'identifiant', 'classe_id', 'date_naissance', 'document_justificatif'];
       

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


}

