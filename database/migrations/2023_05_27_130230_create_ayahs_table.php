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
        Schema::create('ayahs', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('surah_id');
            $table->unsignedSmallInteger('ayah_number');
            $table->unsignedTinyInteger('hizb_number');
            $table->unsignedTinyInteger('rub_el_hizb_number');
            $table->unsignedSmallInteger('ruku_number');
            $table->unsignedTinyInteger('manzil_number');
            $table->unsignedTinyInteger('sajdah_number')
                ->nullable();
            $table->unsignedSmallInteger('page_number');
            $table->unsignedTinyInteger('juz_number');

            $table->foreign('surah_id')
                ->references('id')
                ->on('surahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayahs');
    }
};
