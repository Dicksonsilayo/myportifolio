@extends('layouts.admin')

@section('page-heading', 'Edit Project')

@section('content')

<div class="mb-7">
    <h2 class="text-2xl font-bold text-white">Edit Project</h2>

    <p class="text-gray-400 text-sm mt-1">
        Update the information for {{ $project->title }}.
    </p>
</div>

<form
    action="{{ route('admin.projects.update', $project) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @method('PUT')

    @include('admin.projects._form', [
        'project' => $project,
        'buttonText' => 'Save Changes'
    ])
</form>

@endsection