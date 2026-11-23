@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Skill name --}}
    <div>
        <label for="name" class="block text-sm text-gray-300 mb-2">
            Skill Name <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $skill->name ?? '') }}"
            placeholder="e.g. Laravel"
            class="form-input w-full"
            required
        >

        @error('name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Category --}}
    <div>
        <label for="category" class="block text-sm text-gray-300 mb-2">
            Category <span class="text-red-400">*</span>
        </label>

        <select name="category" id="category" class="form-input w-full" required>
            <option value="">Select category</option>

            @foreach(['Programming Languages', 'Frameworks', 'Frontend Development', 'Databases', 'Tools & Technologies', 'Operating Systems', 'Other'] as $category)
                <option value="{{ $category }}"
                    {{ old('category', $skill->category ?? '') === $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>

        @error('category')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Icon --}}
    <div>
        <label for="icon" class="block text-sm text-gray-300 mb-2">
            Icon Class <span class="text-gray-500">(Optional)</span>
        </label>

        <input
            type="text"
            name="icon"
            id="icon"
            value="{{ old('icon', $skill->icon ?? '') }}"
            placeholder="e.g. devicon-php-plain"
            class="form-input w-full"
        >

        <p class="text-xs text-gray-500 mt-1">
            Enter an icon CSS class if your portfolio supports it.
        </p>

        @error('icon')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Proficiency --}}
    <div>
        <label for="proficiency" class="block text-sm text-gray-300 mb-2">
            Proficiency (%) <span class="text-red-400">*</span>
        </label>

        <input
            type="number"
            name="proficiency"
            id="proficiency"
            value="{{ old('proficiency', $skill->proficiency ?? 70) }}"
            min="0"
            max="100"
            class="form-input w-full"
            required
        >

        @error('proficiency')
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
            value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
            min="0"
            class="form-input w-full"
        >

        <p class="text-xs text-gray-500 mt-1">
            Smaller numbers appear first.
        </p>

        @error('sort_order')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Visibility --}}
    <div class="flex items-center">
        <label class="flex items-center gap-3 cursor-pointer">

            <input
                type="checkbox"
                name="is_visible"
                value="1"
                class="w-5 h-5 accent-purple-500"
                {{ old('is_visible', isset($skill) ? $skill->is_visible : true) ? 'checked' : '' }}
            >

            <span class="text-gray-300">
                Display this skill on my public portfolio
            </span>

        </label>
    </div>

</div>

<div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-gray-700">

    <button type="submit" class="btn-primary">
        {{ isset($skill) ? 'Update Skill' : 'Save Skill' }}
    </button>

    <a href="{{ route('admin.skills.index') }}"
       class="px-5 py-2 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700">
        Cancel
    </a>

</div>