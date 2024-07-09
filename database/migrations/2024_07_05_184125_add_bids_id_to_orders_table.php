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
            $table->unsignedBigInteger('bids_id')->nullable()->after('status');

            // Change existing columns to be nullable
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->unsignedBigInteger('product_owner_id')->nullable()->change();
            $table->timestamp('time')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('transaction_id')->nullable()->change();
            $table->decimal('price', 8, 2)->nullable()->change();
            $table->unsignedBigInteger('payment_by_id')->nullable()->change();
            $table->string('status')->nullable()->change();

            // Add foreign key constraint for bids_id
            $table->foreign('bids_id')->references('id')->on('bids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
             // Drop foreign key constraint and the column
             $table->dropForeign(['bids_id']);
             $table->dropColumn('bids_id');

             // Change columns back to not nullable
             $table->unsignedBigInteger('product_id')->nullable(false)->change();
             $table->unsignedBigInteger('product_owner_id')->nullable(false)->change();
             $table->timestamp('time')->nullable(false)->change();
             $table->string('phone_number')->nullable(false)->change();
             $table->string('transaction_id')->nullable(false)->change();
             $table->decimal('price', 8, 2)->nullable(false)->change();
             $table->unsignedBigInteger('payment_by_id')->nullable(false)->change();
             $table->string('status')->nullable(false)->change();
        });
    }
};
