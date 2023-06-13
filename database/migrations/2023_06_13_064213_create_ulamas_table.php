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
        Schema::create('ulamas', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('kuniyah')
                ->nullable();
            $table->string('nickname')
                ->nullable();
            $table->year('ad_born')
                ->nullable();
            $table->year('ad_wafat')
                ->nullable();
            $table->year('hijri_born')
                ->nullable();
            $table->year('hijri_wafat')
                ->nullable();
            $table->text('biography')
                ->nullable();
            $table->string('level')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulamas');
    }
};
