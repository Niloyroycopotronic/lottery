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
        Schema::create('lottery_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id')->nullable();
            $table->integer('lottery_id')->nullable();
            $table->integer('old_id')->nullable();
            $table->integer('today')->nullable();
            $table->integer('old')->nullable();
            $table->integer('total')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->string('dates')->nullable();
            $table->integer('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_counts');
    }
};
