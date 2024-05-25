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
        Schema::create('bid_approves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('settimers_id');
            $table->string('status');
            $table->foreign('settimers_id')->references('id')->on('set_timers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_approves');
    }
};
