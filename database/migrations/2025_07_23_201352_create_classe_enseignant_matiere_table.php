<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasseEnseignantMatiereTable extends Migration
{
    public function up()
    {
        Schema::create('classe_enseignant_matiere', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enseignant_id')->constrained()->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade');
            $table->foreignId('classe_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['enseignant_id', 'matiere_id', 'classe_id']); // Evite doublons
        });
    }

    public function down()
    {
        Schema::dropIfExists('classe_enseignant_matiere');
    }
}

