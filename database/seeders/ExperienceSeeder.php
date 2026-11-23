<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::updateOrCreate(
            [
                'company' => 'TERNET',
                'position' => 'Software Development Intern',
            ],
            [
                'location' => 'Tanzania',
                'employment_type' => 'Internship / Practical Training',
                'start_date' => '2025-01-01',
                'end_date' => '2026-01-01',
                'is_current' => false,
                'description' =>
                    'Participated in software development internship and practical training activities during 2025 and 2026, gaining practical exposure to software development and IT workflows.',
                'sort_order' => 1,
            ]
        );
    }
}
