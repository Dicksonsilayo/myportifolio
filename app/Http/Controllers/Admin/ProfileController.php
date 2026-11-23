<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the profile management form.
     */
    public function edit()
    {
        // Use one profile record for the entire portfolio.
        $profile = Profile::firstOrNew(['id' => 1]);

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update the portfolio profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'professional_title' => ['nullable', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string', 'max:500'],
            'about' => ['nullable', 'string'],

            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'location' => ['nullable', 'string', 'max:255'],

            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'resume' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            'availability_status' => ['required', 'string', 'max:255'],
        ]);

        // Retrieve the single portfolio profile.
        $profile = Profile::first() ?? new Profile();

        // Remember existing files so we can remove them after replacement.
        $oldPhoto = $profile->profile_photo;
        $oldResume = $profile->resume_path;

        // Update ordinary text fields.
        $profile->fill([
            'full_name' => $validated['full_name'],
            'professional_title' => $validated['professional_title'] ?? null,
            'short_bio' => $validated['short_bio'] ?? null,
            'about' => $validated['about'] ?? null,

            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,

            'github_url' => $validated['github_url'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'website_url' => $validated['website_url'] ?? null,

            'availability_status' => $validated['availability_status'],
        ]);

        // Upload a new profile photo if provided.
        if ($request->hasFile('profile_photo')) {
            $profile->profile_photo = $request
                ->file('profile_photo')
                ->store('profile', 'public');
        }

        // Upload a new CV if provided.
        if ($request->hasFile('resume')) {
            $profile->resume_path = $request
                ->file('resume')
                ->store('resumes', 'public');
        }

        // Save all profile changes.
        $profile->save();

        // Delete old files only after the database save succeeds.
        if (
            $request->hasFile('profile_photo') &&
            $oldPhoto &&
            Storage::disk('public')->exists($oldPhoto)
        ) {
            Storage::disk('public')->delete($oldPhoto);
        }

        if (
            $request->hasFile('resume') &&
            $oldResume &&
            Storage::disk('public')->exists($oldResume)
        ) {
            Storage::disk('public')->delete($oldResume);
        }

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Portfolio profile updated successfully.');
    }
}