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
        Schema::create('up_sale_items', function (Blueprint $table) {
            $table->id();
            $table->string('treatment')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('item_name')->nullable();
            $table->double('item_price')->nullable();
            $table->double('item_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_sale_items');
    }
};
