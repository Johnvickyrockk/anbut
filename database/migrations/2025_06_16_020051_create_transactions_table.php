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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('email');
        $table->string('phone');
        $table->text('address');
        $table->enum('color_type', ['berwarna', 'putih']);
        $table->string('cleaning_service')->nullable();
        $table->decimal('cleaning_price', 10, 2)->default(0);
        $table->string('repaint_service')->nullable();
        $table->decimal('repaint_price', 10, 2)->default(0);
        $table->boolean('pickup_delivery')->default(false);
        $table->decimal('pickup_delivery_price', 10, 2)->default(0);
        $table->decimal('total_amount', 10, 2);
        $table->text('notes')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
