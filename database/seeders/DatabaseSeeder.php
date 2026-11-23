<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProjectSeeder::class,
            SkillSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            CertificationSeeder::class,
        ]);
    }
}
