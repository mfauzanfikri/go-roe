<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $grades = ['SD', 'SMP', 'SMA'];
        $subjects = [
            'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris',
            'IPA', 'IPS', 'Fisika', 'Kimia', 'Biologi',
            'Ekonomi', 'Geografi', 'Sejarah', 'Sosiologi'
        ];

        foreach($grades as $grade) {
            // Student
            $studentUser = User::factory()->create([
                'name' => "Student $grade",
                'email' => strtolower("student_$grade@example.com"),
                'role' => 'student',
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
                'role' => 'tutor',
            ]);

            Tutor::factory()->create([
                'user_id' => $tutorUser->id,
                'grade' => $grade,
                'subject' => fake()->randomElement($subjects),
                'address' => fake()->address,
                'available_days' => ['Senin', 'Rabu', 'Jumat'],
            ]);
        }

        // Random 3 students
        User::factory()
            ->count(3)
            ->create(['role' => 'student'])
            ->each(function($user) {
                Student::factory()->create([
                    'user_id' => $user->id,
                    'grade' => fake()->randomElement(['SD', 'SMP', 'SMA']),
                    'address' => fake()->address,
                ]);
            });

        // Random 3 tutors
        User::factory()
            ->count(3)
            ->create(['role' => 'tutor'])
            ->each(function($user) use ($subjects) {
                Tutor::factory()->create([
                    'user_id' => $user->id,
                    'grade' => fake()->randomElement(['SD', 'SMP', 'SMA']),
                    'subject' => fake()->randomElement($subjects),
                    'address' => fake()->address,
                    'available_days' => ['Selasa', 'Kamis'],
                ]);
            });
    }
}
