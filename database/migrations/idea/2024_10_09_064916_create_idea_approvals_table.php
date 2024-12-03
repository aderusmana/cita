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
        Schema::create('idea_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idea_id')->constrained('ideas');
            $table->string('approval_id');
            $table->string('status', 100);
            $table->text('note')->nullable();
            $table->string('approval_stage', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idea_approvals');
    }
};
