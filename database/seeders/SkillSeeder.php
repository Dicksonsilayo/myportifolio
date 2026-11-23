<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'Backend', 'icon' => 'fab fa-php', 'proficiency' => 75],
            ['name' => 'Laravel', 'category' => 'Backend', 'icon' => 'fab fa-laravel', 'proficiency' => 75],
            ['name' => 'Python', 'category' => 'Backend', 'icon' => 'fab fa-python', 'proficiency' => 60],

            // Frontend
            ['name' => 'HTML5', 'category' => 'Frontend', 'icon' => 'fab fa-html5', 'proficiency' => 85],
            ['name' => 'CSS3', 'category' => 'Frontend', 'icon' => 'fab fa-css3-alt', 'proficiency' => 80],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'icon' => 'fab fa-js', 'proficiency' => 65],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'icon' => 'fab fa-bootstrap', 'proficiency' => 75],

            // Database
            ['name' => 'MariaDB', 'category' => 'Database', 'icon' => 'fas fa-database', 'proficiency' => 75],
            ['name' => 'MySQL', 'category' => 'Database', 'icon' => 'fas fa-database', 'proficiency' => 75],

            // Tools and Systems
            ['name' => 'Linux / Ubuntu', 'category' => 'Tools & Systems', 'icon' => 'fab fa-linux', 'proficiency' => 70],
            ['name' => 'Git & GitHub', 'category' => 'Tools & Systems', 'icon' => 'fab fa-github', 'proficiency' => 75],
        ];

        foreach ($skills as $index => $skill) {

            $skill['sort_order'] = $index + 1;
            $skill['is_visible'] = true;

            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }
    }
}
