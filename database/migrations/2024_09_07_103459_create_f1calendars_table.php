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
        Schema::create('f1calendars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('race_name');
            $table->string('race_location');
            $table->dateTime('race_date');
            $table->string('race_country_code');
            $table->string('race_country_name');
            $table->string('race_api_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('f1calendars');
    }
};
