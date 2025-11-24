<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items_claimed', function (Blueprint $table) {
            // Only add the lost_item_id column if it does not exist
            if (!Schema::hasColumn('items_claimed', 'lost_item_id')) {
                $table->foreignId('item_lost_id')->constrained('items_lost')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('items_claimed', function (Blueprint $table) {
            if (Schema::hasColumn('items_claimed', 'lost_item_id')) {
                $table->dropForeign(['lost_item_id']);
                $table->dropColumn('lost_item_id');
            }
        });
    }
};
