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
    Schema::table('enseignants', function (Blueprint $table) {
        $table->string('password')->default(bcrypt('password123'));
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enseignants', function (Blueprint $table) {
            //
        });
    }
};
