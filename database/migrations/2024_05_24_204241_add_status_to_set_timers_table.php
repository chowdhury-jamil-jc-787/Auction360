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
        Schema::table('set_timers', function (Blueprint $table) {
            // Add status column
            $table->string('status')->nullable();

            // Add user_id column as a foreign key
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('set_timers', function (Blueprint $table) {
            // Drop columns if the migration is rolled back
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('status');
        });
    }
};
