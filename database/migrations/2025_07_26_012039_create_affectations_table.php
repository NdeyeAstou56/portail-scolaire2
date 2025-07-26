<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('affectations', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('enseignant_id');
    $table->unsignedBigInteger('classe_id');
    $table->unsignedBigInteger('matiere_id');
    $table->timestamps();

    // Clés étrangères (à adapter selon ton modèle)
    $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade');
    $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
    $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
