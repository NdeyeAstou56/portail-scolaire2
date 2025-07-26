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
    Schema::table('periodes', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->foreignId('annee_scolaire_id')->constrained('annee_scolaires')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('periodes', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropForeign(['annee_scolaire_id']);
        $table->dropColumn('annee_scolaire_id');
    });
}
};
