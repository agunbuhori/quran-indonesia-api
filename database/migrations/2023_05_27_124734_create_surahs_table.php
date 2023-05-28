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
        Schema::create('surahs', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('revelation_order');
            $table->enum('revelation_place', ['makkah', 'madinah']);
            $table->boolean('bismillah');
            $table->string('name_simple', 50);
            $table->string('name_complex', 50);
            $table->string('name_arabic', 50);
            $table->string('name_indonesian', 50);
            $table->string('pages', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surahs');
    }
};
