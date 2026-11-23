@extends('layouts.admin')

@section('page-heading', 'Project Management')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">

    <div>
        <h2 class="text-2xl font-bold text-white">My Projects</h2>
        <p class="text-gray-400 text-sm mt-1">
            Manage the projects displayed on your portfolio.
        </p>
    </div>

    <a href="{{ route('admin.projects.create') }}" class="btn-primary text-center">
        + Add New Project
    </a>

</div>

{{-- Search and Statistics --}}
<div class="admin-card p-5 mb-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <p class="text-gray-400 text-sm">Total Projects</p>
            <p class="text-3xl font-bold text-white mt-1">
                {{ $projects->total() }}
            </p>
        </div>

        <form action="{{ route('admin.projects.index') }}" method="GET"
              class="flex flex-col sm:flex-row gap-2">

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search projects..."
                class="form-input sm:w-72"
            >

            <button type="submit" class="btn-primary">
                Search
            </button>

            @if($search)
                <a href="{{ route('admin.projects.index') }}"
                   class="px-4 py-3 rounded-lg bg-gray-700 text-white text-center">
                    Clear
                </a>
            @endif

        </form>

    </div>

</div>

{{-- Projects Table --}}
<div class="admin-card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-gray-800/70 text-gray-400 text-xs uppercase">

                <tr>
                    <th class="px-5 py-4">Project</th>
                    <th class="px-5 py-4">Category</th>
                    <th class="px-5 py-4">Featured</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4">Actions</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-gray-800">

                @forelse($projects as $project)

                    <tr class="hover:bg-gray-800/30">

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3 min-w-56">

                                @if($project->image_path)
                                    <img
                                        src="{{ asset('storage/' . $project->image_path) }}"
                                        alt="{{ $project->title }}"
                                        class="w-14 h-12 object-cover rounded-lg"
                                    >
                                @else
                                    <div class="w-14 h-12 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                                        ◈
                                    </div>
                                @endif

                                <div>
                                    <p class="font-semibold text-white">
                                        {{ $project->title }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $project->slug }}
                                    </p>
                                </div>

                            </div>

                        </td>

                        <td class="px-5 py-4 text-sm text-gray-400">
                            {{ $project->category ?: 'Uncategorized' }}
                        </td>

                        <td class="px-5 py-4">

                            @if($project->is_featured)
                                <span class="text-yellow-400 text-xs font-semibold">
                                    ★ Featured
                                </span>
                            @else
                                <span class="text-gray-500 text-xs">
                                    Not featured
                                </span>
                            @endif

                        </td>

                        <td class="px-5 py-4">

                            @if($project->is_published)
                                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs">
                                    Published
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-gray-700 text-gray-300 text-xs">
                                    Draft
                                </span>
                            @endif

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route('admin.projects.edit', $project) }}"
                                    class="text-blue-400 hover:text-blue-300 text-sm"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.projects.destroy', $project) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-400 hover:text-red-300 text-sm">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">

                            <div class="text-4xl mb-3">◈</div>

                            <p class="text-white font-semibold">
                                No projects found
                            </p>

                            <p class="text-gray-500 text-sm mt-2">
                                Add your first project to get started.
                            </p>

                            <a href="{{ route('admin.projects.create') }}"
                               class="inline-block mt-5 btn-primary">
                                Add Project
                            </a>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if($projects->hasPages())
        <div class="p-5 border-t border-gray-800">
            {{ $projects->links() }}
        </div>
    @endif

</div>

@endsection