<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->enum('method', ['cod', 'system']);
            $table->integer('amount');
            $table->string('status'); // pending, success, failed
            $table->string('transaction_id')->nullable(); // Midtrans transaction_id
            $table->string('snap_token')->nullable();     // Midtrans snap token
            $table->string('transaction_status')->nullable(); // Midtrans status like 'settlement', 'expire', etc.
            $table->string('fraud_status')->nullable();   // Midtrans fraud check
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
