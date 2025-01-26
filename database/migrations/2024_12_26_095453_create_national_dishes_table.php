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
        Schema::create('national_dishes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('dish_name');
            $table->string('dish_country_name');
            $table->string('dish_country_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_dishes');
    }
};
