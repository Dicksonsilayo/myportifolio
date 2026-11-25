@extends('layouts.admin')

@section('title', 'Manage Skills')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-white">Skills Management</h1>
        <p class="text-gray-400 mt-1">
            Manage the technical and professional skills displayed on my portfolio.
        </p>
    </div>

    <a href="{{ route('admin.skills.create') }}"
       class="btn-primary inline-flex items-center justify-center gap-2">
        <span>+</span>
        Add New Skill
    </a>
</div>

{{-- Search and filters --}}
<div class="admin-card mb-6">
    <form action="{{ route('admin.skills.index') }}" method="GET"
          class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2">
            <label for="search" class="block text-sm text-gray-300 mb-2">
                Search skills
            </label>

            <input
                type="text"
                name="search"
                id="search"
                value="{{ request('search') }}"
                placeholder="Search by skill name or category..."
                class="form-input w-full"
            >
        </div>

        <div>
            <label for="visibility" class="block text-sm text-gray-300 mb-2">
                Visibility
            </label>

            <select name="visibility" id="visibility" class="form-input w-full">
                <option value="">All skills</option>
                <option value="visible" {{ request('visibility') === 'visible' ? 'selected' : '' }}>
                    Visible
                </option>
                <option value="hidden" {{ request('visibility') === 'hidden' ? 'selected' : '' }}>
                    Hidden
                </option>
            </select>
        </div>

        <div class="md:col-span-3 flex flex-wrap gap-3">
            <button type="submit" class="btn-primary">
                Search
            </button>

            <a href="{{ route('admin.skills.index') }}"
               class="px-5 py-2 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- Skills table --}}
<div class="admin-card overflow-hidden">

    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-semibold text-white">All Skills</h2>

        <span class="text-sm text-gray-400">
            {{ $skills->total() }} skills found
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

            <thead class="text-gray-400 border-b border-gray-700">
                <tr>
                    <th class="py-4 px-3">Skill</th>
                    <th class="py-4 px-3">Category</th>
                    <th class="py-4 px-3">Proficiency</th>
                    <th class="py-4 px-3">Visibility</th>
                    <th class="py-4 px-3">Order</th>
                    <th class="py-4 px-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-700">

                @forelse($skills as $skill)

                    <tr class="hover:bg-gray-800/50">

                        <td class="py-4 px-3">
                            <div class="font-medium text-white">
                                {{ $skill->name }}
                            </div>

                            @if($skill->icon)
                                <div class="text-xs text-gray-500 mt-1">
                                    Icon: {{ $skill->icon }}
                                </div>
                            @endif
                        </td>

                        <td class="py-4 px-3 text-gray-300">
                            {{ $skill->category }}
                        </td>

                        <td class="py-4 px-3 min-w-40">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-gray-700 rounded-full h-2">
                                    <div
                                        class="bg-purple-500 h-2 rounded-full"
                                        style="width: {{ $skill->proficiency }}%">
                                    </div>
                                </div>

                                <span class="text-gray-300 text-xs">
                                    {{ $skill->proficiency }}%
                                </span>
                            </div>
                        </td>

                        <td class="py-4 px-3">
                            @if($skill->is_visible)
                                <span class="px-3 py-1 text-xs rounded-full bg-green-500/10 text-green-400">
                                    Visible
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-gray-500/10 text-gray-400">
                                    Hidden
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-3 text-gray-300">
                            {{ $skill->sort_order }}
                        </td>

                        <td class="py-4 px-3">
                            <div class="flex justify-end items-center gap-3">

                                <a href="{{ route('admin.skills.edit', $skill) }}"
                                   class="text-blue-400 hover:text-blue-300">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.skills.destroy', $skill) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this skill?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-400 hover:text-red-300">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-400">
                            No skills found. Add your first skill to get started.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $skills->links() }}
    </div>

</div>

@endsection