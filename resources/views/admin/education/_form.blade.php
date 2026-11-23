@csrf

<div class="admin-card p-6 space-y-5">

    <div>
        <label class="block text-sm text-gray-300 mb-2">
            Institution *
        </label>

        <input
            type="text"
            name="institution"
            value="{{ old('institution', $education->institution ?? '') }}"
            class="form-input"
            placeholder="e.g. St Joseph University in Tanzania"
            required
        >
    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-2">
            Qualification *
        </label>

        <input
            type="text"
            name="qualification"
            value="{{ old('qualification', $education->qualification ?? '') }}"
            class="form-input"
            placeholder="e.g. Bachelor of Science"
            required
        >
    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-2">
            Field of Study
        </label>

        <input
            type="text"
            name="field_of_study"
            value="{{ old('field_of_study', $education->field_of_study ?? '') }}"
            class="form-input"
            placeholder="e.g. Computer Science"
        >
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm text-gray-300 mb-2">
                Start Date
            </label>

            <input
                type="date"
                name="start_date"
                value="{{ old('start_date', isset($education?->start_date) ? $education->start_date->format('Y-m-d') : '') }}"
                class="form-input"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-2">
                End Date
            </label>

            <input
                type="date"
                name="end_date"
                value="{{ old('end_date', isset($education?->end_date) ? $education->end_date->format('Y-m-d') : '') }}"
                class="form-input"
            >
        </div>

    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-2">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="form-input"
            placeholder="Add relevant details about your studies, achievements, or academic activities..."
        >{{ old('description', $education->description ?? '') }}</textarea>
    </div>

</div>

<div class="flex flex-wrap gap-3 mt-6">

    <button type="submit" class="btn-primary">
        {{ $buttonText }}
    </button>

    <a href="{{ route('admin.education.index') }}"
       class="px-5 py-3 rounded-lg bg-gray-700 text-white hover:bg-gray-600">
        Cancel
    </a>

</div>