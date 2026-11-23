@csrf

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Main Information --}}
    <div class="lg:col-span-2 space-y-6">

        <div class="admin-card p-6 space-y-5">

            <h3 class="text-lg font-bold text-white">Project Information</h3>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Project Title *</label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $project->title ?? '') }}"
                    class="form-input"
                    placeholder="e.g. Office Visitor Management System"
                    required
                >
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Category</label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category', $project->category ?? '') }}"
                    class="form-input"
                    placeholder="e.g. Web Development"
                >
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Short Description *</label>

                <textarea
                    name="short_description"
                    rows="3"
                    maxlength="500"
                    class="form-input"
                    placeholder="A short summary of your project..."
                    required
                >{{ old('short_description', $project->short_description ?? '') }}</textarea>

                <p class="text-xs text-gray-500 mt-1">
                    Maximum 500 characters.
                </p>
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Full Description *</label>

                <textarea
                    name="description"
                    rows="9"
                    class="form-input"
                    placeholder="Explain the project, technologies used, features, and challenges..."
                    required
                >{{ old('description', $project->description ?? '') }}</textarea>
            </div>

        </div>

        {{-- Links --}}
        <div class="admin-card p-6 space-y-5">

            <h3 class="text-lg font-bold text-white">Project Links</h3>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Live Project URL</label>

                <input
                    type="url"
                    name="project_url"
                    value="{{ old('project_url', $project->project_url ?? '') }}"
                    class="form-input"
                    placeholder="https://example.com"
                >
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-2">GitHub Repository URL</label>

                <input
                    type="url"
                    name="github_url"
                    value="{{ old('github_url', $project->github_url ?? '') }}"
                    class="form-input"
                    placeholder="https://github.com/username/project"
                >
            </div>

        </div>

    </div>

    {{-- Sidebar Settings --}}
    <div class="space-y-6">

        <div class="admin-card p-6 space-y-5">

            <h3 class="text-lg font-bold text-white">Project Settings</h3>

            <div>
                <label class="block text-sm text-gray-300 mb-2">Display Order</label>

                <input
                    type="number"
                    name="sort_order"
                    min="0"
                    value="{{ old('sort_order', $project->sort_order ?? 0) }}"
                    class="form-input"
                >

                <p class="text-xs text-gray-500 mt-2">
                    Smaller numbers appear first.
                </p>
            </div>

            <div class="border-t border-gray-700 pt-5">

                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        class="w-4 h-4 accent-purple-500"
                        @checked(old('is_featured', $project->is_featured ?? false))
                    >

                    <span class="text-sm text-gray-300">
                        Feature this project
                    </span>
                </label>

            </div>

            <div>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        class="w-4 h-4 accent-purple-500"
                        @checked(old('is_published', $project->is_published ?? true))
                    >

                    <span class="text-sm text-gray-300">
                        Publish project
                    </span>
                </label>

                <p class="text-xs text-gray-500 mt-2">
                    Unpublished projects will not appear on your public portfolio.
                </p>

            </div>

        </div>

        {{-- Image Upload --}}
        <div class="admin-card p-6 space-y-4">

            <h3 class="text-lg font-bold text-white">Project Image</h3>

            @if(isset($project) && $project->image_path)
                <div>
                    <p class="text-xs text-gray-400 mb-2">Current image</p>

                    <img
                        src="{{ asset('storage/' . $project->image_path) }}"
                        alt="{{ $project->title }}"
                        class="w-full h-40 object-cover rounded-lg"
                    >
                </div>
            @endif

            <input
                type="file"
                name="image"
                id="image"
                accept="image/jpeg,image/png,image/webp"
                class="form-input text-sm"
            >

            <p class="text-xs text-gray-500">
                JPG, JPEG, PNG or WEBP. Maximum size: 4 MB.
            </p>

            <div id="image-preview-container" class="hidden">
                <p class="text-xs text-gray-400 mb-2">New image preview</p>

                <img
                    id="image-preview"
                    src=""
                    alt="Image preview"
                    class="w-full h-40 object-cover rounded-lg"
                >
            </div>

        </div>

    </div>

</div>

<div class="flex flex-wrap gap-3 mt-6">

    <button type="submit" class="btn-primary">
        {{ $buttonText }}
    </button>

    <a href="{{ route('admin.projects.index') }}"
       class="px-5 py-3 rounded-lg bg-gray-700 text-white hover:bg-gray-600">
        Cancel
    </a>

</div>

@push('scripts')
<script>
    const imageInput = document.getElementById('image');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        const preview = document.getElementById('image-preview');
        const container = document.getElementById('image-preview-container');

        preview.src = URL.createObjectURL(file);
        container.classList.remove('hidden');
    });
</script>
@endpush