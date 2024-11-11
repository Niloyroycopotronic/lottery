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
        Schema::create('last_data', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id')->nullable();
            $table->integer('lottery_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_data');
    }
};
