<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Bulletin;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'active'];

    public function periodes()
    {
        return $this->hasMany(Periode::class);
    }
     public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }
}

