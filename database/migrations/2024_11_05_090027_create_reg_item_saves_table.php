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
        Schema::create('reg_item_saves', function (Blueprint $table) {
            $table->id();
            $table->integer('reg_item_id')->nullable();
            $table->integer('reg_id')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('value', 10, 2)->default(0);
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_item_saves');
    }
};
