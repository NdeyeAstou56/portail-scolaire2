<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eleve_parent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['parent_id', 'eleve_id']); // pour éviter les doublons
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eleve_parent');
    }
};
