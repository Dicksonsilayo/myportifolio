@extends('layouts.admin')

@section('page-heading', 'Dashboard')

@section('content')

<div class="mb-8">
    <h2 class="text-2xl font-bold text-white">
        Welcome back, {{ auth()->user()->name }}!
    </h2>

    <p class="text-gray-400 mt-2">
        Here's an overview of your professional portfolio.
    </p>
</div>

{{-- Statistics --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">

    {{-- Projects --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Total Projects</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['projects'] }}
                </h3>
            </div>
            <div class="text-3xl text-purple-400">▣</div>
        </div>
        <a href="{{ route('admin.projects.index') }}"
           class="text-purple-400 text-sm inline-block mt-5 hover:text-purple-300">
            Manage projects →
        </a>
    </div>

    {{-- Skills --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Total Skills</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['skills'] }}
                </h3>
            </div>
            <div class="text-3xl text-blue-400">✦</div>
        </div>
        <p class="text-gray-500 text-sm mt-5">Technical skills in your portfolio</p>
    </div>

    {{-- Experience --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Experience Records</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['experiences'] }}
                </h3>
            </div>
            <div class="text-3xl text-green-400">▤</div>
        </div>
        <p class="text-gray-500 text-sm mt-5">Professional experience</p>
    </div>

    {{-- Certifications --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Certifications</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['certifications'] }}
                </h3>
            </div>
            <div class="text-3xl text-yellow-400">★</div>
        </div>
        <p class="text-gray-500 text-sm mt-5">Professional certificates</p>
    </div>

    {{-- Messages --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Total Messages</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['messages'] }}
                </h3>
            </div>
            <div class="text-3xl text-pink-400">✉</div>
        </div>
        <p class="text-gray-500 text-sm mt-5">Messages received from visitors</p>
    </div>

    {{-- Unread Messages --}}
    <div class="admin-card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Unread Messages</p>
                <h3 class="text-3xl font-bold text-white mt-2">
                    {{ $statistics['unread_messages'] }}
                </h3>
            </div>
            <div class="text-3xl text-orange-400">●</div>
        </div>
        <p class="text-gray-500 text-sm mt-5">Messages waiting for your attention</p>
    </div>

</div>

{{-- Quick Actions --}}
<div class="admin-card p-6">

    <h3 class="text-lg font-bold text-white mb-5">
        Quick Actions
    </h3>

    <div class="flex flex-wrap gap-3">

        <a href="{{ route('admin.projects.create') }}"
           class="btn-primary">
            + Add New Project
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="px-5 py-3 rounded-lg bg-gray-700 text-white hover:bg-gray-600">
            Manage Projects
        </a>

        <a href="{{ route('home') }}"
           target="_blank"
           class="px-5 py-3 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-800">
            View Public Portfolio ↗
        </a>

    </div>

</div>

@endsection