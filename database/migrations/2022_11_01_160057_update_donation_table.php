<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //delete portions column
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('portions');
        });
        // add campus_id
        Schema::table('meals', function (Blueprint $table) {
            $table->foreignId('campuse_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
