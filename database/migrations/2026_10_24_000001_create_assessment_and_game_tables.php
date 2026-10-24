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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number')->unique();
            $table->string('dimension'); // EE, DP, PA
            $table->string('dimension_name'); // Kelelahan Emosional, Depersonalisasi, Rendahnya Prestasi Pribadi
            $table->text('question_text');
            $table->boolean('is_reversed')->default(false);
            $table->unsignedTinyInteger('scale_min')->default(0);
            $table->unsignedTinyInteger('scale_max')->default(6);
            $table->json('scale_labels')->nullable();
            $table->unsignedInteger('order')->default(1);
            $table->timestamps();
        });

        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // pre_test, post_test
            $table->string('status')->default('completed'); // in_progress, completed
            $table->unsignedInteger('ee_score')->default(0); // Emotional Exhaustion (max 54)
            $table->unsignedInteger('dp_score')->default(0); // Depersonalization (max 30)
            $table->unsignedInteger('pa_score')->default(0); // Personal Accomplishment (max 48)
            $table->unsignedInteger('total_score')->default(0); // Total MBI Score (max 132)
            $table->decimal('percentage', 5, 2)->default(0.00); // 0.00 - 100.00%
            $table->string('category')->default('Rendah'); // Rendah, Sedang, Tinggi
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('assessment_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('raw_score')->default(0); // 0 - 6
            $table->unsignedTinyInteger('calculated_score')->default(0); // after reverse scoring if PA
            $table->timestamps();
        });

        Schema::create('game_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assessment_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('score')->default(0);
            $table->unsignedInteger('items_smashed')->default(0);
            $table->unsignedInteger('max_combo')->default(0);
            $table->unsignedInteger('duration_seconds')->default(30);
            $table->boolean('boss_defeated')->default(false);
            $table->timestamp('played_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_logs');
        Schema::dropIfExists('assessment_answers');
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('questions');
    }
};
