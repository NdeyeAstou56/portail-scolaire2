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
    Schema::table('periodes', function (Blueprint $table) {
        $table->string('libelle')->after('id'); // ou à l'endroit approprié
    });
}



    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('periodes', function (Blueprint $table) {
        $table->dropColumn('libelle');
    });
}
};
