@extends('layouts.admin')

@section('page-heading', 'Education Management')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">

    <div>
        <h2 class="text-2xl font-bold text-white">
            Academic Qualifications
        </h2>

        <p class="text-gray-400 text-sm mt-1">
            Manage your academic background and qualifications.
        </p>
    </div>

    <a href="{{ route('admin.education.create') }}" class="btn-primary text-center">
        + Add Education
    </a>

</div>

<div class="admin-card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-gray-800/70 text-gray-400 text-xs uppercase">
                <tr>
                    <th class="px-5 py-4">Institution</th>
                    <th class="px-5 py-4">Qualification</th>
                    <th class="px-5 py-4">Field of Study</th>
                    <th class="px-5 py-4">Period</th>
                    <th class="px-5 py-4">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">

                @forelse($education as $item)

                    <tr class="hover:bg-gray-800/30">

                        <td class="px-5 py-4">
                            <p class="font-semibold text-white">
                                {{ $item->institution }}
                            </p>
                        </td>

                        <td class="px-5 py-4 text-sm text-gray-300">
                            {{ $item->qualification }}
                        </td>

                        <td class="px-5 py-4 text-sm text-gray-400">
                            {{ $item->field_of_study ?: 'Not specified' }}
                        </td>

                        <td class="px-5 py-4 text-sm text-gray-400 whitespace-nowrap">
                            {{ $item->start_date?->format('M Y') ?? '—' }}
                            –
                            {{ $item->end_date?->format('M Y') ?? 'Present' }}
                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <a href="{{ route('admin.education.edit', $item) }}"
                                   class="text-blue-400 hover:text-blue-300 text-sm">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.education.destroy', $item) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this education record?')"
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

                            <p class="text-white font-semibold">
                                No education records found.
                            </p>

                            <p class="text-gray-500 text-sm mt-2">
                                Add your academic qualifications to get started.
                            </p>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($education->hasPages())
        <div class="p-5 border-t border-gray-800">
            {{ $education->links() }}
        </div>
    @endif

</div>

@endsection