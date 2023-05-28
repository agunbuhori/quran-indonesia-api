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
        Schema::create('kalimahs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('ayah_id');
            $table->unsignedTinyInteger('position');
            $table->enum('char_type_name', ['word', 'end']);
            $table->unsignedSmallInteger('page_number');
            $table->unsignedTinyInteger('line_number');
            $table->string('text', 50);
            $table->timestamps();

            $table->foreign('ayah_id')
                ->references('id')
                ->on('ayahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalimahs');
    }
};
