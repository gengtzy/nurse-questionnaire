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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('type')->default('butterfly_hug');
            $table->integer('tension_before')->default(6);
            $table->integer('tension_after')->default(6);
            $table->integer('tension_diff')->default(0);
            $table->integer('duration_seconds')->default(120);
            $table->integer('tempo_ms')->nullable()->default(1600);
            $table->integer('taps_count')->default(0);
            $table->boolean('completed')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
