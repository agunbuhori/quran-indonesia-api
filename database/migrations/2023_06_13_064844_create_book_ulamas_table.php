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
        Schema::create('book_ulamas', function (Blueprint $table) {
            $table->unsignedSmallInteger('book_id');
            $table->unsignedSmallInteger('ulama_id');

            $table->foreign('book_id')
                ->references('id')
                ->on('books');

            $table->foreign('ulama_id')
                ->references('id')
                ->on('ulamas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_ulamas');
    }
};
