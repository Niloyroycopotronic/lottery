<?php

use App\StatusEnum;
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
        Schema::create('ticket_names', function (Blueprint $table) {
            $table->id();
            $table->integer('ticket_id')->nullable();
            $table->string('name')->nullable();
            $table->decimal('value', 10, 2)->default(0);
            $table->integer('page')->default(0);
            $table->integer('status')->default(StatusEnum::ACTIVE->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_names');
    }
};
