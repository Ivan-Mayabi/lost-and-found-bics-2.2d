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
        Schema::create('items_claimed', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('verified')->default(2)->comment('0 -> unverified, 1-> verified, 2->pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_claimed');
    }
};
