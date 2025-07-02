<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $grades = ['SD', 'SMP', 'SMA'];

        // Buat minimal 1 student dan 1 tutor untuk setiap grade
        foreach ($grades as $grade) {
            // Student
            $studentUser = User::factory()->create([
                'name' => "Student $grade",
                'email' => strtolower("student_$grade@example.com"),
            ]);

            Student::factory()->create([
                'user_id' => $studentUser->id,
                'grade' => $grade,
                'address' => fake()->address,
            ]);

            // Tutor
            $tutorUser = User::factory()->create([
                'name' => "Tutor $grade",
                'email' => strtolower("tutor_$grade@example.com"),
            ]);

            Tutor::factory()->create([
                'user_id' => $tutorUser->id,
                'grade' => $grade,
                'subject' => fake()->randomElement([
                    'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris',
                    'IPA', 'IPS', 'Fisika', 'Kimia', 'Biologi',
                    'Ekonomi', 'Geografi', 'Sejarah', 'Sosiologi'
                ]),
                'address' => fake()->address,
                'available_days' => ['Senin', 'Rabu', 'Jumat'],
            ]);
        }

        // Tambahan: buat random 3 student dan 3 tutor lainnya
        User::factory()
            ->count(3)
            ->create()
            ->each(function ($user) {
                Student::factory()->create([
                    'user_id' => $user->id,
                    'grade' => fake()->randomElement(['SD', 'SMP', 'SMA']),
                    'address' => fake()->address,
                ]);
            });

        User::factory()
            ->count(3)
            ->create()
            ->each(function ($user) {
                Tutor::factory()->create([
                    'user_id' => $user->id,
                    'grade' => fake()->randomElement(['SD', 'SMP', 'SMA']),
                    'subject' => fake()->randomElement([
                        'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris',
                        'IPA', 'IPS', 'Fisika', 'Kimia', 'Biologi',
                        'Ekonomi', 'Geografi', 'Sejarah', 'Sosiologi'
                    ]),
                    'address' => fake()->address,
                    'available_days' => ['Selasa', 'Kamis'],
                ]);
            });
    }
}
