@extends('layouts.admin')

@section('title', 'Add Skill')

@section('content')

<div class="mb-8">
    <a href="{{ route('admin.skills.index') }}"
       class="text-purple-400 hover:text-purple-300 text-sm">
        &larr; Back to Skills
    </a>

    <h1 class="text-2xl font-bold text-white mt-4">
        Add New Skill
    </h1>

    <p class="text-gray-400 mt-1">
        Add a technical or professional skill to your portfolio.
    </p>
</div>

<div class="admin-card max-w-4xl">

    <form action="{{ route('admin.skills.store') }}" method="POST">

        @include('admin.skills._form')

    </form>

</div>

@endsection