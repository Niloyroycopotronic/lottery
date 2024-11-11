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
        Schema::create('roll_amounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('volt_id');
            $table->foreign('volt_id')->references('id')->on('volts')->onDelete('cascade');
            $table->decimal('value', total: 10, places: 2)->default(0);
            $table->integer('count')->default(0);
            $table->decimal('amount', total: 10, places: 2)->default(0);
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roll_amounts');
    }
};
