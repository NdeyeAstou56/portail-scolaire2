<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'active'];

    public function periodes()
    {
        return $this->hasMany(Periode::class);
    }
}

