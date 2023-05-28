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
        Schema::create('topic_ayahs', function (Blueprint $table) {
            $table->unsignedSmallInteger('topic_id');
            $table->unsignedSmallInteger('ayah_id');

            $table->foreign('topic_id')
                ->references('id')
                ->on('topics');

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
        Schema::dropIfExists('topic_ayahs');
    }
};
