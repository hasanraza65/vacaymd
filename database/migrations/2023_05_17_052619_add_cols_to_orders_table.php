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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('home_state')->nullable();
            $table->string('home_city')->nullable();
            $table->string('hotel_city')->nullable();
            $table->string('our_pharmacy_text')->default('off')->nullable();
            $table->string('confirm_patient_id')->default('off')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
