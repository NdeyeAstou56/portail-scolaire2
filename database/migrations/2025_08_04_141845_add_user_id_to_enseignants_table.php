<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_08_04_141845_add_user_id_to_enseignants_table.php

public function up()
{
    Schema::table('enseignants', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->after('id');
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
