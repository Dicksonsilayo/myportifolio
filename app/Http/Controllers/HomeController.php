<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();

        $skills = Skill::where('is_visible', true)
            ->orderBy('sort_order')
            ->get();

        $experiences = Experience::orderByDesc('start_date')
            ->get();

        $education = Education::orderByDesc('end_date')
            ->get();

        $certifications = Certification::latest()
            ->take(6)
            ->get();

        return view('home', compact(
            'projects',
            'skills',
            'experiences',
            'education',
            'certifications'
        ));
    }
}
