@extends('layouts.admin')

@section('page-heading', 'Add Education')

@section('content')

<div class="mb-7">
    <h2 class="text-2xl font-bold text-white">
        Add Academic Qualification
    </h2>

    <p class="text-gray-400 text-sm mt-1">
        Enter the details of your education.
    </p>
</div>

<form action="{{ route('admin.education.store') }}" method="POST">

    @include('admin.education._form', [
        'buttonText' => 'Save Education'
    ])

</form>

@endsection