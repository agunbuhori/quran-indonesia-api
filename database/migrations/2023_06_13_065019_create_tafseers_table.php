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
        Schema::create('tafseers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('book_id');
            $table->unsignedSmallInteger('ayah_id');
            $table->longText('text')
                ->nullable();
            $table->text('asbabun_nazal')
                ->nullable();


            $table->foreign('book_id')
                ->references('id')
                ->on('books');

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
        Schema::dropIfExists('tafseers');
    }
};
