@extends('layouts.admin')

@section('page-heading', 'Add New Project')

@section('content')

<div class="mb-7">
    <h2 class="text-2xl font-bold text-white">Create Project</h2>

    <p class="text-gray-400 text-sm mt-1">
        Add a new project to your professional portfolio.
    </p>
</div>

<form
    action="{{ route('admin.projects.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @include('admin.projects._form', [
        'buttonText' => 'Create Project'
    ])
</form>

@endsection