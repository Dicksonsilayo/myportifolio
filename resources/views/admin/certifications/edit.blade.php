@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">
            Edit Certification
        </h1>

        <p class="text-gray-400 mt-2">
            Update your certification information.
        </p>
    </div>

    <div class="admin-card p-6">

        <form
            action="{{ route('admin.certifications.update', $certification) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            @include('admin.certifications._form', [
                'certification' => $certification,
                'buttonText' => 'Update Certification'
            ])

        </form>

    </div>

</div>

@endsection