<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAnneeScolaireIdToPeriodesTableV2 extends Migration
{
    public function up()
    {
        Schema::table('periodes', function (Blueprint $table) {
            // Ajouter la colonne nullable (sans contrainte FK encore)
            $table->unsignedBigInteger('annee_scolaire_id')->nullable()->after('id');
        });

        // Mettre à jour les enregistrements existants avec un ID valide
        // Remplace ici '1' par l'ID réel dans ta table annees_scolaires
        DB::table('periodes')->whereNull('annee_scolaire_id')->update(['annee_scolaire_id' => 1]);

        // Rendre la colonne non nullable (attention, nécessite doctrine/dbal installé)
        Schema::table('periodes', function (Blueprint $table) {
            $table->unsignedBigInteger('annee_scolaire_id')->nullable(false)->change();
        });

        // Ajouter la contrainte de clé étrangère
        Schema::table('periodes', function (Blueprint $table) {
            $table->foreign('annee_scolaire_id')->references('id')->on('annee_scolaires')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('periodes', function (Blueprint $table) {
            // Supprimer la contrainte FK puis la colonne
            $table->dropForeign(['annee_scolaire_id']);
            $table->dropColumn('annee_scolaire_id');
        });
    }
}
