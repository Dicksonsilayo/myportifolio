<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display all professional experiences.
     */
    public function index(Request $request)
    {
        $query = Experience::query();

        // Search by position or company.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('position', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        // Filter current or previous employment.
        if ($request->filled('status')) {
            if ($request->status === 'current') {
                $query->where('is_current', true);
            } elseif ($request->status === 'previous') {
                $query->where('is_current', false);
            }
        }

        $experiences = $query
            ->orderByDesc('start_date')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating experience.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a new experience.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'employment_type' => [
                'nullable',
                'string',
                'in:Internship,Full-time,Part-time,Contract,Freelance,Volunteer,Other'
            ],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        // Current employment must not have an end date.
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Experience::create($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience added successfully.');
    }

    /**
     * Show the form for editing experience.
     */
    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update an existing experience.
     */
    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'employment_type' => [
                'nullable',
                'string',
                'in:Internship,Industrial practical Training (field),Full-time,Part-time,Contract,Freelance,Volunteer,Other'
            ],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $experience->update($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully.');
    }

    /**
     * Delete an experience.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully.');
    }
}