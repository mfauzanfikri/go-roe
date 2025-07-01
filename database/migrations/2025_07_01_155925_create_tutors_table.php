<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('grade'); // SD, SMP, SMA
            $table->string('subject'); // Ex: Matematika
            $table->json('available_days'); // Simpan array nama hari (Senin, Selasa, dst.)
            $table->text('description')->nullable();
            $table->text('address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
