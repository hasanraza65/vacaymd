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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name')->nullable();
            $table->integer('on_ed')->default(0);
            $table->integer('on_uti')->default(0);
            $table->integer('on_hangover')->default(0);
            $table->integer('on_suncare')->default(0);
            $table->integer('on_periodavoidance')->default(0);
            $table->integer('on_motionsickness')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
