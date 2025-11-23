<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items_claimed', function (Blueprint $table) {
            // Only add the column if it does not exist
            if (!Schema::hasColumn('items_claimed', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('items_claimed', 'lost_item_id')) {
                $table->foreignId('lost_item_id')->constrained('items_lost')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('items_claimed', function (Blueprint $table) {
            if (Schema::hasColumn('items_claimed', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('items_claimed', 'lost_item_id')) {
                $table->dropForeign(['lost_item_id']);
                $table->dropColumn('lost_item_id');
            }
        });
    }
};
