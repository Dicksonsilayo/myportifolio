@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('content')

<div class="mb-8">

    <a href="{{ route('admin.experiences.index') }}"
       class="text-purple-400 hover:text-purple-300 text-sm">
        &larr; Back to Experience
    </a>

    <h1 class="text-2xl font-bold text-white mt-4">
        Edit Experience
    </h1>

    <p class="text-gray-400 mt-1">
        Update your experience at {{ $experience->company }}.
    </p>

</div>

<div class="admin-card max-w-4xl">

    <form
        action="{{ route('admin.experiences.update', $experience) }}"
        method="POST">

        @method('PUT')

        @include('admin.experiences._form')

    </form>

</div>

@endsection