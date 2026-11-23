<div class="space-y-6">

    <div>
        <label class="block text-sm font-medium mb-2">
            Certification Name *
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $certification->name ?? '') }}"
            class="form-input w-full"
            placeholder="Example: Arduino Programming"
            required
        >

        @error('name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">
            Issuing Organization *
        </label>

        <input
            type="text"
            name="issuing_organization"
            value="{{ old('issuing_organization', $certification->issuing_organization ?? '') }}"
            class="form-input w-full"
            placeholder="Example: TERNET"
            required
        >

        @error('issuing_organization')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">
            Issue Date
        </label>

        <input
            type="date"
            name="issue_date"
            value="{{ old('issue_date', isset($certification) && $certification->issue_date ? $certification->issue_date->format('Y-m-d') : '') }}"
            class="form-input w-full"
        >

        @error('issue_date')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">
            Credential Verification URL
        </label>

        <input
            type="url"
            name="credential_url"
            value="{{ old('credential_url', $certification->credential_url ?? '') }}"
            class="form-input w-full"
            placeholder="https://example.com/verify"
        >

        @error('credential_url')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">
            Certificate Image or PDF
        </label>

        <input
            type="file"
            name="image_path"
            accept=".jpg,.jpeg,.png,.webp,.pdf"
            class="form-input w-full"
        >

        <p class="text-gray-400 text-xs mt-2">
            Accepted formats: JPG, JPEG, PNG, WEBP and PDF. Maximum size: 5 MB.
        </p>

        @error('image_path')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        @if(isset($certification) && $certification->image_path)

            <div class="mt-4">

                <p class="text-sm text-gray-400 mb-2">
                    Currently uploaded certificate:
                </p>

                <a
                    href="{{ asset('storage/' . $certification->image_path) }}"
                    target="_blank"
                    class="text-purple-400 hover:text-purple-300 underline"
                >
                    View current certificate
                </a>

            </div>

        @endif
    </div>

    <div>
        <label class="block text-sm font-medium mb-2">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="form-input w-full"
            placeholder="Describe what you learned or achieved..."
        >{{ old('description', $certification->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3">

        <button type="submit" class="btn-primary">
            {{ $buttonText }}
        </button>

        <a
            href="{{ route('admin.certifications.index') }}"
            class="px-5 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-white"
        >
            Cancel
        </a>

    </div>

</div>