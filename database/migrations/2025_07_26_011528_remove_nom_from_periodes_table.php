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
        $table->dropColumn('nom');
    });
}

public function down()
{
    Schema::table('periodes', function (Blueprint $table) {
        $table->string('nom'); // à adapter au type original si nécessaire
    });
}

};
