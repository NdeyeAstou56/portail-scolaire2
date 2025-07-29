<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = ['eleve_id', 'periode_id', 'moyenne_generale', 'mention', 'rang', 'appreciation'];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
   
public function notes()
{
    return $this->hasMany(Note::class);
}

public function classe()
{
    return $this->belongsTo(Classe::class);
}
public function annee_scolaire()
{
    return $this->belongsTo(AnneeScolaire::class);
}


}

