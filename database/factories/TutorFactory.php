<?php

namespace Database\Factories;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorFactory extends Factory
{
    protected $model = Tutor::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'tutor']),
            'grade' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'subject' => $this->faker->randomElement([
                'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS',
                'Fisika', 'Kimia', 'Biologi', 'Ekonomi', 'Geografi', 'Sejarah', 'Sosiologi'
            ]),
            'available_days' => $this->faker->randomElements(
                ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                rand(2, 5)
            ),
            'description' => $this->faker->paragraph(5),
            'address' => $this->faker->address,
        ];
    }
}
