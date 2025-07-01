<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            $table->string('program'); // SD, SMP, SMA
            $table->string('subject');
            $table->string('day'); // contoh: "Senin"
            $table->string('time'); // contoh: "08.00 - 10.00"
            $table->date('date');
            $table->enum('status', ['order', 'fee_paid', 'paid', 'learning', 'completed'])->default('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
