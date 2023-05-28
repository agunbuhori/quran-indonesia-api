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
        Schema::create('translations', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedTinyInteger('translation_version_id');
            $table->morphs('translatable');
            $table->text('text');

            $table->foreign('translation_version_id')
                ->references('id')
                ->on('translation_versions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
