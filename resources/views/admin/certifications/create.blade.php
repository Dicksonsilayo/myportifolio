@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">
            Add Certification
        </h1>

        <p class="text-gray-400 mt-2">
            Add a professional certification or achievement to your portfolio.
        </p>
    </div>

    <div class="admin-card p-6">

        <form
            action="{{ route('admin.certifications.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @include('admin.certifications._form', [
                'buttonText' => 'Save Certification'
            ])

        </form>

    </div>

</div>

@endsection