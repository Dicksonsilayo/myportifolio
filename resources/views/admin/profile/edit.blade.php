@extends('layouts.admin')

@section('title', 'Manage Profile')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Page heading --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Profile Management</h1>
            <p class="text-gray-400 mt-1">
                Manage the personal and professional information displayed on your portfolio.
            </p>
        </div>

        <a href="{{ route('home') }}" target="_blank"
           class="btn-primary text-center">
            View Portfolio
        </a>
    </div>

    <form action="{{ route('admin.profile.update') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Personal information --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">Personal Information</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Your name and professional introduction.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm text-gray-300 mb-2">
                        Full Name <span class="text-red-400">*</span>
                    </label>

                    <input type="text"
                           name="full_name"
                           value="{{ old('full_name', $profile->full_name) }}"
                           class="form-input w-full"
                           placeholder="Your full name"
                           required>

                    @error('full_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-2">
                        Professional Title
                    </label>

                    <input type="text"
                           name="professional_title"
                           value="{{ old('professional_title', $profile->professional_title) }}"
                           class="form-input w-full"
                           placeholder="e.g. Software Developer">

                    @error('professional_title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-300 mb-2">
                        Short Introduction
                    </label>

                    <textarea name="short_bio"
                              rows="3"
                              maxlength="500"
                              class="form-input w-full"
                              placeholder="Write a short professional introduction...">{{ old('short_bio', $profile->short_bio) }}</textarea>

                    @error('short_bio')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-300 mb-2">
                        About Me
                    </label>

                    <textarea name="about"
                              rows="6"
                              class="form-input w-full"
                              placeholder="Write your detailed professional biography...">{{ old('about', $profile->about) }}</textarea>

                    @error('about')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Contact information --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">Contact Information</h2>
                <p class="text-sm text-gray-400 mt-1">
                    How visitors can reach you.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm text-gray-300 mb-2">Email Address</label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $profile->email) }}"
                           class="form-input w-full"
                           placeholder="your@email.com">

                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-2">Phone Number</label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $profile->phone) }}"
                           class="form-input w-full"
                           placeholder="+255 ...">

                    @error('phone')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-300 mb-2">Location</label>

                    <input type="text"
                           name="location"
                           value="{{ old('location', $profile->location) }}"
                           class="form-input w-full"
                           placeholder="e.g. Dar es Salaam, Tanzania">

                    @error('location')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Social links --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">Social Links</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Add your professional and social profiles.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm text-gray-300 mb-2">GitHub URL</label>

                    <input type="url"
                           name="github_url"
                           value="{{ old('github_url', $profile->github_url) }}"
                           class="form-input w-full"
                           placeholder="https://github.com/username">

                    @error('github_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-2">LinkedIn URL</label>

                    <input type="url"
                           name="linkedin_url"
                           value="{{ old('linkedin_url', $profile->linkedin_url) }}"
                           class="form-input w-full"
                           placeholder="https://linkedin.com/in/username">

                    @error('linkedin_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-300 mb-2">Personal Website</label>

                    <input type="url"
                           name="website_url"
                           value="{{ old('website_url', $profile->website_url) }}"
                           class="form-input w-full"
                           placeholder="https://yourwebsite.com">

                    @error('website_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Profile photo --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">Profile Photo</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Upload a professional photo for your portfolio.
                </p>
            </div>

            @if($profile->profile_photo)
                <div>
                    <p class="text-sm text-gray-300 mb-3">Current Photo</p>

                    <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                         alt="Profile photo"
                         class="w-32 h-32 rounded-full object-cover border-2 border-purple-500">
                </div>
            @endif

            <div>
                <label class="block text-sm text-gray-300 mb-2">
                    Choose a New Photo
                </label>

                <input type="file"
                       name="profile_photo"
                       accept="image/jpeg,image/png,image/webp"
                       class="form-input w-full">

                <p class="text-xs text-gray-500 mt-2">
                    Accepted formats: JPG, JPEG, PNG and WEBP. Maximum size: 4 MB.
                </p>

                @error('profile_photo')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Resume --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">CV / Resume</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Upload the CV visitors can access from your portfolio.
                </p>
            </div>

            @if($profile->resume_path)
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm text-green-400">
                        A CV has already been uploaded.
                    </span>

                    <a href="{{ asset('storage/' . $profile->resume_path) }}"
                       target="_blank"
                       class="text-purple-400 hover:text-purple-300 text-sm underline">
                        View Current CV
                    </a>
                </div>
            @endif

            <div>
                <label class="block text-sm text-gray-300 mb-2">
                    Choose a New CV
                </label>

                <input type="file"
                       name="resume"
                       accept="application/pdf"
                       class="form-input w-full">

                <p class="text-xs text-gray-500 mt-2">
                    PDF format only. Maximum size: 5 MB.
                </p>

                @error('resume')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Availability --}}
        <div class="admin-card space-y-5">
            <div>
                <h2 class="text-lg font-semibold text-white">Availability Status</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Let visitors know whether you are open to opportunities.
                </p>
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">
                    Current Status
                </label>

                <select name="availability_status" class="form-input w-full">
                    @php
                        $availability = old(
                            'availability_status',
                            $profile->availability_status ?? 'Available for opportunities'
                        );
                    @endphp

                    <option value="Available for opportunities"
                        {{ $availability === 'Available for opportunities' ? 'selected' : '' }}>
                        Available for opportunities
                    </option>

                    <option value="Open to work"
                        {{ $availability === 'Open to work' ? 'selected' : '' }}>
                        Open to work
                    </option>

                    <option value="Available for freelance projects"
                        {{ $availability === 'Available for freelance projects' ? 'selected' : '' }}>
                        Available for freelance projects
                    </option>

                    <option value="Not currently available"
                        {{ $availability === 'Not currently available' ? 'selected' : '' }}>
                        Not currently available
                    </option>
                </select>

                @error('availability_status')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Save button --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-end">
            <button type="submit" class="btn-primary">
                Save Profile Changes
            </button>
        </div>

    </form>
</div>
@endsection