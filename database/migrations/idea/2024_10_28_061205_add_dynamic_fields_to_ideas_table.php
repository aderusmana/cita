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
        Schema::table('ideas', function (Blueprint $table) {
            $table->text('before')->nullable();
            $table->text('after')->nullable();
            $table->string('benefit')->nullable();
            $table->string('sumber_best_practice')->nullable();
            $table->string('proses_improve')->nullable();
            $table->string('nama_ai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropColumn('before');
            $table->dropColumn('after');
            $table->dropColumn('benefit');
            $table->dropColumn('sumber_best_practice');
            $table->dropColumn('proses_improve');
            $table->dropColumn('nama_ai');
        });
    }
};
