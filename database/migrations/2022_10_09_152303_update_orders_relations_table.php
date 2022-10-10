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
        //relations for orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('meal_id');
            $table->foreignId('status_id');
            $table->foreignId('mealbox_id');
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
