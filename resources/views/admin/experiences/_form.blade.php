@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Position --}}
    <div>
        <label for="position" class="block text-sm text-gray-300 mb-2">
            Job Position <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="position"
            id="position"
            value="{{ old('position', $experience->position ?? '') }}"
            placeholder="e.g. Software Development Intern"
            class="form-input w-full"
            required
        >

        @error('position')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Company --}}
    <div>
        <label for="company" class="block text-sm text-gray-300 mb-2">
            Company / Organization <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="company"
            id="company"
            value="{{ old('company', $experience->company ?? '') }}"
            placeholder="e.g. TERNET"
            class="form-input w-full"
            required
        >

        @error('company')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Location --}}
    <div>
        <label for="location" class="block text-sm text-gray-300 mb-2">
            Location
        </label>

        <input
            type="text"
            name="location"
            id="location"
            value="{{ old('location', $experience->location ?? '') }}"
            placeholder="e.g. Dar es Salaam, Tanzania"
            class="form-input w-full"
        >

        @error('location')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Employment type --}}
    <div>
        <label for="employment_type" class="block text-sm text-gray-300 mb-2">
            Employment Type
        </label>

        <select name="employment_type" id="employment_type" class="form-input w-full">

            <option value="">Select employment type</option>

            @foreach(['Internship','Industrial practical Training (field)', 'Full-time', 'Part-time', 'Contract', 'Freelance', 'Volunteer', 'Other'] as $type)
                <option value="{{ $type }}"
                    {{ old('employment_type', $experience->employment_type ?? '') === $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach

        </select>

        @error('employment_type')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Start date --}}
    <div>
        <label for="start_date" class="block text-sm text-gray-300 mb-2">
            Start Date <span class="text-red-400">*</span>
        </label>

        <input
            type="date"
            name="start_date"
            id="start_date"
            value="{{ old('start_date', isset($experience) ? $experience->start_date?->format('Y-m-d') : '') }}"
            class="form-input w-full"
            required
        >

        @error('start_date')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- End date --}}
    <div>
        <label for="end_date" class="block text-sm text-gray-300 mb-2">
            End Date
        </label>

        <input
            type="date"
            name="end_date"
            id="end_date"
            value="{{ old('end_date', isset($experience) ? $experience->end_date?->format('Y-m-d') : '') }}"
            class="form-input w-full"
        >

        <p class="text-xs text-gray-500 mt-1">
            Leave empty if this experience is ongoing.
        </p>

        @error('end_date')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Current employment --}}
    <div class="md:col-span-2">
        <label class="flex items-center gap-3 cursor-pointer">

            <input
                type="checkbox"
                name="is_current"
                value="1"
                class="w-5 h-5 accent-purple-500"
                {{ old('is_current', isset($experience) ? $experience->is_current : false) ? 'checked' : '' }}
            >

            <span class="text-gray-300">
                I currently work in this position
            </span>

        </label>
    </div>

    {{-- Description --}}
    <div class="md:col-span-2">
        <label for="description" class="block text-sm text-gray-300 mb-2">
            Description
        </label>

        <textarea
            name="description"
            id="description"
            rows="6"
            placeholder="Describe your responsibilities, achievements and technologies used..."
            class="form-input w-full"
        >{{ old('description', $experience->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Sort order --}}
    <div>
        <label for="sort_order" class="block text-sm text-gray-300 mb-2">
            Display Order
        </label>

        <input
            type="number"
            name="sort_order"
            id="sort_order"
            min="0"
            value="{{ old('sort_order', $experience->sort_order ?? 0) }}"
            class="form-input w-full"
        >

        <p class="text-xs text-gray-500 mt-1">
            Smaller numbers have higher display priority.
        </p>

        @error('sort_order')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-gray-700">

    <button type="submit" class="btn-primary">
        {{ isset($experience) ? 'Update Experience' : 'Save Experience' }}
    </button>

    <a href="{{ route('admin.experiences.index') }}"
       class="px-5 py-2 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700">
        Cancel
    </a>

</div>