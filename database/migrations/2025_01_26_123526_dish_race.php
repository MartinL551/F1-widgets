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
        Schema::create('dish_race', function (Blueprint $table) {
            $table->id();
            $table->string('dish_id');
            $table->foreign('dish_id')
              ->references('id')
              ->on('f1_races');
            $table->string('race_id');
            $table->foreign('race_id')
              ->references('id')
              ->on('national_dishes')->onDelete('cascade');
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_race');
    }
};
