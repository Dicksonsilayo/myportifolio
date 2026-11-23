<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Office Visitor and Task Management System',
                'slug' => 'office-visitor-task-management-system',
                'category' => 'Web Application',
                'short_description' =>
                    'An integrated platform for managing office visitors, staff tasks and administrative workflows.',
                'description' =>
                    'A database-driven office management application designed to improve visitor registration, task allocation, staff coordination and administrative operations. The system includes role-based access and task management workflows.',
                'image_path' => null,
                'project_url' => null,
                'github_url' => 'https://github.com/disebene/office_visitor',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],

            [
                'title' => 'D-Beat Music Store',
                'slug' => 'd-beat-music-store',
                'category' => 'E-Commerce',
                'short_description' =>
                    'An online musical instruments store for browsing products and making bookings.',
                'description' =>
                    'A Laravel e-commerce application focused on musical instruments and audio equipment. Customers can browse categories, explore products and submit bookings. The application also includes administrative booking management.',
                'image_path' => null,
                'project_url' => null,
                'github_url' => null,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],

            [
                'title' => 'GitHub Activity Tracker',
                'slug' => 'github-activity-tracker',
                'category' => 'CLI Application',
                'short_description' =>
                    'A command-line tool for retrieving and displaying recent GitHub user activity.',
                'description' =>
                    'A developer-oriented command-line application that communicates with the GitHub API, retrieves user activity and processes JSON responses for readable terminal output.',
                'image_path' => null,
                'project_url' => null,
                'github_url' => null,
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
