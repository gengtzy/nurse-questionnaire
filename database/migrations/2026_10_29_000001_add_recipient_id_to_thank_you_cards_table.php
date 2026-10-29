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
        Schema::table('thank_you_cards', function (Blueprint $table) {
            $table->foreignId('recipient_id')->nullable()->after('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_read')->default(false)->after('message');
            $table->timestamp('read_at')->nullable()->after('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thank_you_cards', function (Blueprint $table) {
            $table->dropForeign(['recipient_id']);
            $table->dropColumn(['recipient_id', 'is_read', 'read_at']);
        });
    }
};

