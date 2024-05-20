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
        Schema::create('antonims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kata_id')->constrained('katas');
            $table->foreignId('antonim_id')->constrained('katas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antonims');
    }
};
