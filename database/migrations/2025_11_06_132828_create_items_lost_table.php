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
        Schema::create('items_lost', function (Blueprint $table) {
            $table->id();
            $table->date('date_lost');
            $table->string('description')->nullable()->default(null);
            $table->string('place_lost');
            $table->string('image_url')->nullable()->default(null);
            $table->boolean('taken')->nullable()->default(0);
            $table->dateTime('date_taken')->nullable();
            $table->integer('user_taken_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_lost');
    }
};
