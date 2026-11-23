<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display all skills.
     */
    public function index(Request $request)
    {
        $query = Skill::query();

        // Search by skill name or category.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by visibility.
        if ($request->filled('visibility')) {
            $query->where(
                'is_visible',
                $request->visibility === 'visible'
            );
        }

        $skills = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a skill.
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a new skill.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'proficiency' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    /**
     * Show the form for editing a skill.
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update an existing skill.
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'proficiency' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    /**
     * Delete a skill.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}