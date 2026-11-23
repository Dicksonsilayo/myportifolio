<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        Education::updateOrCreate(
            [
                'institution' => 'St Joseph University in Tanzania',
                'qualification' => 'Bachelor of Science',
            ],
            [
                'field_of_study' => 'Computer Science in Computer Science',
                'start_date' => '2023-01-01',
                'end_date' => '2026-01-01',
                'description' =>
                    'Academic studies focused on computer science, programming, software development, databases and information technology.',
            ]
        );
    }
}
