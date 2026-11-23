@extends('layouts.admin')

@section('title', 'Manage Experience')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-white">Experience Management</h1>
        <p class="text-gray-400 mt-1">
            Manage your professional experience and career history.
        </p>
    </div>

    <a href="{{ route('admin.experiences.create') }}"
       class="btn-primary inline-flex items-center justify-center gap-2">
        <span>+</span>
        Add Experience
    </a>
</div>

{{-- Search and filters --}}
<div class="admin-card mb-6">
    <form action="{{ route('admin.experiences.index') }}"
          method="GET"
          class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="md:col-span-2">
            <label for="search" class="block text-sm text-gray-300 mb-2">
                Search experience
            </label>

            <input
                type="text"
                name="search"
                id="search"
                value="{{ request('search') }}"
                placeholder="Search by position or company..."
                class="form-input w-full"
            >
        </div>

        <div>
            <label for="status" class="block text-sm text-gray-300 mb-2">
                Employment status
            </label>

            <select name="status" id="status" class="form-input w-full">
                <option value="">All experiences</option>

                <option value="current"
                    {{ request('status') === 'current' ? 'selected' : '' }}>
                    Current
                </option>

                <option value="previous"
                    {{ request('status') === 'previous' ? 'selected' : '' }}>
                    Previous
                </option>
            </select>
        </div>

        <div class="md:col-span-3 flex flex-wrap gap-3">
            <button type="submit" class="btn-primary">
                Search
            </button>

            <a href="{{ route('admin.experiences.index') }}"
               class="px-5 py-2 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- Experience table --}}
<div class="admin-card overflow-hidden">

    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-semibold text-white">
            Professional Experience
        </h2>

        <span class="text-sm text-gray-400">
            {{ $experiences->total() }} records found
        </span>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="text-gray-400 border-b border-gray-700">
                <tr>
                    <th class="py-4 px-3">Position</th>
                    <th class="py-4 px-3">Company</th>
                    <th class="py-4 px-3">Employment Type</th>
                    <th class="py-4 px-3">Period</th>
                    <th class="py-4 px-3">Status</th>
                    <th class="py-4 px-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-700">

                @forelse($experiences as $experience)

                    <tr class="hover:bg-gray-800/50">

                        <td class="py-4 px-3">
                            <div class="font-medium text-white">
                                {{ $experience->position }}
                            </div>

                            @if($experience->location)
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $experience->location }}
                                </div>
                            @endif
                        </td>

                        <td class="py-4 px-3 text-gray-300">
                            {{ $experience->company }}
                        </td>

                        <td class="py-4 px-3 text-gray-300">
                            {{ $experience->employment_type ?: 'Not specified' }}
                        </td>

                        <td class="py-4 px-3 text-gray-300 whitespace-nowrap">
                            {{ $experience->start_date?->format('M Y') }}
                            –
                            {{ $experience->is_current
                                ? 'Present'
                                : ($experience->end_date?->format('M Y') ?? 'Not specified') }}
                        </td>

                        <td class="py-4 px-3">
                            @if($experience->is_current)
                                <span class="px-3 py-1 text-xs rounded-full bg-green-500/10 text-green-400">
                                    Current
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-gray-500/10 text-gray-400">
                                    Previous
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-3">
                            <div class="flex justify-end items-center gap-3">

                                <a href="{{ route('admin.experiences.edit', $experience) }}"
                                   class="text-blue-400 hover:text-blue-300">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.experiences.destroy', $experience) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this experience?')">

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
                            No experience records found. Add your first experience.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $experiences->links() }}
    </div>

</div>

@endsection