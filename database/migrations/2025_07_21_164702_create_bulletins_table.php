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
       Schema::create('bulletins', function (Blueprint $table) {
    $table->id();
    $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
    $table->foreignId('periode_id')->constrained('periodes')->onDelete('cascade');
    $table->float('moyenne_generale')->nullable();
    $table->string('mention')->nullable(); // ex: Bien, Très bien...
    $table->integer('rang')->nullable();
    $table->text('appreciation')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
