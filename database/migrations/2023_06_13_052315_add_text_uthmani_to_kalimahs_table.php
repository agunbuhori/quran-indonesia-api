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
        Schema::table('kalimahs', function (Blueprint $table) {
            $table->string('text_uthmani', 30)
                ->after('text_v2');

            $table->string('text_uthmani_hafs', 30)
                ->after('text_uthmani');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kalimahs', function (Blueprint $table) {
            $table->dropColumn('text_uthmani');
            $table->dropColumn('text_uthmani_hafs');
        });
    }
};
