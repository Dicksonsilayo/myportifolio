<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    /**
     * Display all certifications.
     */
    public function index()
    {
        $certifications = Certification::latest()->paginate(10);

        return view('admin.certifications.index', compact('certifications'));
    }

    /**
     * Show the form for creating a certification.
     */
    public function create()
    {
        return view('admin.certifications.create');
    }

    /**
     * Store a new certification.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuing_organization' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'credential_url' => ['nullable', 'url', 'max:255'],
            'image_path' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')
                ->store('certifications', 'public');
        }

        Certification::create($validated);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification added successfully.');
    }

    /**
     * Show the form for editing a certification.
     */
    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    /**
     * Update an existing certification.
     */
    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuing_organization' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'credential_url' => ['nullable', 'url', 'max:255'],
            'image_path' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image_path')) {

            // Delete the previous certificate file.
            if ($certification->image_path) {
                Storage::disk('public')->delete($certification->image_path);
            }

            // Store the replacement file.
            $validated['image_path'] = $request->file('image_path')
                ->store('certifications', 'public');
        }

        $certification->update($validated);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification updated successfully.');
    }

    /**
     * Delete a certification.
     */
    public function destroy(Certification $certification)
    {
        if ($certification->image_path) {
            Storage::disk('public')->delete($certification->image_path);
        }

        $certification->delete();

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification deleted successfully.');
    }
}