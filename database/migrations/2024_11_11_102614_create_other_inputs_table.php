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
        Schema::create('other_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('reg_id')->nullable();
            $table->string('other_id')->nullable();
            $table->string('today_qty')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('total_qty', 10, 2)->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('dates')->nullable();
            $table->string('user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_inputs');
    }
};
