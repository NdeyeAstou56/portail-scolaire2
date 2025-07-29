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
    Schema::table('periodes', function (Blueprint $table) {
        $table->boolean('en_cours')->default(false);
    });
}

public function down(): void
{
    Schema::table('periodes', function (Blueprint $table) {
        $table->dropColumn('en_cours');
    });
}

};
