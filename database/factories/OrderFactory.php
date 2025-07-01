<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $student = User::factory()->create(['role' => 'student']);
        $tutor = User::factory()->create(['role' => 'tutor']);

        return [
            'student_id' => $student->id,
            'tutor_id' => $tutor->id,
            'program' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'subject' => $this->faker->randomElement(['Matematika', 'IPA', 'Bahasa Inggris']),
            'day' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu']),
            'time' => $this->faker->randomElement(['08.00 - 10.00', '13.00 - 15.00', '19.00 - 21.00']),
            'date' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'status' => 'order',
        ];
    }
}

