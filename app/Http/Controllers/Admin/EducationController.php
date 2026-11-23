<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display all academic qualifications.
     */
    public function index()
    {
        $education = Education::orderByDesc('end_date')
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('admin.education.index', compact('education'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Save a new academic qualification.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        Education::create($validated);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education record added successfully.');
    }

    /**
     * Show the edit form.
     */
    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    /**
     * Update an academic qualification.
     */
    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        $education->update($validated);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education record updated successfully.');
    }

    /**
     * Delete an academic qualification.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'Education record deleted successfully.');
    }
}