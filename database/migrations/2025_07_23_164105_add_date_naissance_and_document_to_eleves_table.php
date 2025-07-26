<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('eleves', function (Blueprint $table) {
        $table->date('date_naissance')->nullable(); // si pas encore ajoutée
        // $table->string('document_justificatif')->nullable(); // supprimer ou commenter car déjà existante
    });
}



    public function down(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->dropColumn(['date_naissance', 'document_justificatif']);
        });
    }
};
