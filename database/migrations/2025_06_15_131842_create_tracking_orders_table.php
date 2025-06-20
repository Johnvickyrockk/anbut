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
        Schema::create('tracking_orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_number')->unique();
    $table->string('customer_name');
    $table->string('customer_email');
    $table->string('status'); // e.g., 'processing', 'shipped', 'delivered'
    $table->text('message')->nullable();
    $table->text('admin_notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_orders');
    }
};
