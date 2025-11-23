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
        Schema::create('id_replacements', function (Blueprint $table) {
            $table->id();
            $table->string('id_lost');
            $table->unsignedTinyInteger('approved')->default(2)->comment('0 -> unverified, 1-> verified, 2->pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_replacements');
    }
};
