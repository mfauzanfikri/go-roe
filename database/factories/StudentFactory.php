<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'student']),
            'grade' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'address' => $this->faker->address,
        ];
    }
}
