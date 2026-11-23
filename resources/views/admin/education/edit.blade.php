@extends('layouts.admin')

@section('page-heading', 'Edit Education')

@section('content')

<div class="mb-7">
    <h2 class="text-2xl font-bold text-white">
        Edit Academic Qualification
    </h2>

    <p class="text-gray-400 text-sm mt-1">
        Update {{ $education->institution }}.
    </p>
</div>

<form
    action="{{ route('admin.education.update', $education) }}"
    method="POST"
>
    @method('PUT')

    @include('admin.education._form', [
        'education' => $education,
        'buttonText' => 'Update Education'
    ])

</form>

@endsection