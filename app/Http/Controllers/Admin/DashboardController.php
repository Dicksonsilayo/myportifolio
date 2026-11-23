<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Message;
use App\Models\Experience;
use App\Models\Certification;

class DashboardController extends Controller
{
    public function index()
    {
        $statistics = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'experiences' => Experience::count(),
            'certifications' => Certification::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('statistics'));
    }
}