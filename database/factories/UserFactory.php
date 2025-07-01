<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $role = $this->faker->randomElement(['student', 'tutor']);
        return [
            'name' => $this->faker->name(),
            'role' => $role,
            'grade' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'subject' => $role === 'tutor' ? $this->faker->randomElement([
                'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS'
            ]) : null,
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
