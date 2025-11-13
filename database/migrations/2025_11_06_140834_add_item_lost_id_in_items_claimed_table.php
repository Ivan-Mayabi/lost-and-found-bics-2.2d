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
        Schema::table('items_claimed', function (Blueprint $table) {
            $table->foreignId('item_lost_id')->constrained('items_lost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items_claimed', function (Blueprint $table) {
            $table->dropConstrainedForeignId('item_lost_id');
        });
    }
};
