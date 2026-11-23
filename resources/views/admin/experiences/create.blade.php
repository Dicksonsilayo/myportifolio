@extends('layouts.admin')

@section('title', 'Add Experience')

@section('content')

<div class="mb-8">

    <a href="{{ route('admin.experiences.index') }}"
       class="text-purple-400 hover:text-purple-300 text-sm">
        &larr; Back to Experience
    </a>

    <h1 class="text-2xl font-bold text-white mt-4">
        Add Professional Experience
    </h1>

    <p class="text-gray-400 mt-1">
        Record your employment, internship or professional experience.
    </p>

</div>

<div class="admin-card max-w-4xl">

    <form action="{{ route('admin.experiences.store') }}" method="POST">

        @include('admin.experiences._form')

    </form>

</div>

@endsection