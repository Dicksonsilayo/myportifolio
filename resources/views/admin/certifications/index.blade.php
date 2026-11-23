@extends('layouts.admin')

@section('content')

<div>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Certifications
            </h1>

            <p class="text-gray-400 mt-2">
                Manage your certificates and professional achievements.
            </p>
        </div>

        <a
            href="{{ route('admin.certifications.create') }}"
            class="btn-primary"
        >
            + Add Certification
        </a>

    </div>

    <div class="admin-card overflow-hidden">

        @if($certifications->count())

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-800 text-gray-300">

                        <tr>
                            <th class="p-4">Certification</th>
                            <th class="p-4">Organization</th>
                            <th class="p-4">Issue Date</th>
                            <th class="p-4">Certificate</th>
                            <th class="p-4">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($certifications as $certification)

                            <tr class="border-t border-gray-700">

                                <td class="p-4">

                                    <div class="font-semibold text-white">
                                        {{ $certification->name }}
                                    </div>

                                    @if($certification->credential_url)
                                        <a
                                            href="{{ $certification->credential_url }}"
                                            target="_blank"
                                            class="text-purple-400 text-xs hover:underline"
                                        >
                                            Verify credential
                                        </a>
                                    @endif

                                </td>

                                <td class="p-4 text-gray-300">
                                    {{ $certification->issuing_organization }}
                                </td>

                                <td class="p-4 text-gray-300">
                                    {{ $certification->issue_date?->format('M Y') ?? 'Not specified' }}
                                </td>

                                <td class="p-4">

                                    @if($certification->image_path)

                                        <a
                                            href="{{ asset('storage/' . $certification->image_path) }}"
                                            target="_blank"
                                            class="text-blue-400 hover:underline"
                                        >
                                            View file
                                        </a>

                                    @else

                                        <span class="text-gray-500">
                                            No file
                                        </span>

                                    @endif

                                </td>

                                <td class="p-4">

                                    <div class="flex items-center gap-3">

                                        <a
                                            href="{{ route('admin.certifications.edit', $certification) }}"
                                            class="text-blue-400 hover:text-blue-300"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.certifications.destroy', $certification) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this certification?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-400 hover:text-red-300"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="p-4">
                {{ $certifications->links() }}
            </div>

        @else

            <div class="p-10 text-center">

                <div class="text-5xl mb-4">🏆</div>

                <h3 class="text-xl font-semibold text-white">
                    No certifications yet
                </h3>

                <p class="text-gray-400 mt-2">
                    Start by adding your first certification.
                </p>

                <a
                    href="{{ route('admin.certifications.create') }}"
                    class="btn-primary inline-block mt-5"
                >
                    Add Your First Certification
                </a>

            </div>

        @endif

    </div>

</div>

@endsection