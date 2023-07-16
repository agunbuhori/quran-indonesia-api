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
            $table->unsignedTinyInteger('line_number')
                ->after('page_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kalimahs', function (Blueprint $table) {
            // $table->dropColumn('line_number')
        });
    }
};
