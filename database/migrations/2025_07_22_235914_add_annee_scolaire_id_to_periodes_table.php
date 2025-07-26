<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Ajouter la colonne nullable
        Schema::table('periodes', function (Blueprint $table) {
            $table->foreignId('annee_scolaire_id')->nullable()->constrained()->onDelete('cascade');
        });

        // 2. Mettre à jour les enregistrements existants avec une valeur par défaut
        // Récupérer un id d'annee_scolaire existant (à adapter selon ta base)
        $defaultAnneeId = DB::table('annees_scolaires')->value('id');

        DB::table('periodes')->update(['annee_scolaire_id' => $defaultAnneeId]);

        // 3. Modifier la colonne pour la rendre non nullable
        // Pour utiliser change(), il faut le package doctrine/dbal installé via composer
        Schema::table('periodes', function (Blueprint $table) {
            $table->foreignId('annee_scolaire_id')->nullable(false)->constrained()->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('periodes', function (Blueprint $table) {
            $table->dropForeign(['annee_scolaire_id']);
            $table->dropColumn('annee_scolaire_id');
        });
    }
};
