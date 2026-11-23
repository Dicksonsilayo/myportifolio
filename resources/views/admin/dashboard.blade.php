<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Dickson Silayo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #080b14;
            font-family: Arial, sans-serif;
        }

        .dashboard-card {
            background: #111827;
            border: 1px solid #263247;
        }
    </style>
</head>

<body class="text-white min-h-screen">

    <header class="border-b border-gray-800 bg-gray-950">
        <div class="max-w-7xl mx-auto px-6 py-5 flex
                    justify-between items-center">

            <h1 class="text-2xl font-bold">
                DS<span class="text-purple-500">.</span>
                <span class="text-gray-400 text-sm ml-2">
                    Admin Panel
                </span>
            </h1>

            <div class="flex items-center gap-5">
                <span class="text-gray-300 text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf

                    <button class="bg-red-600 hover:bg-red-700
                                   px-4 py-2 rounded-lg text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-10">
            <h2 class="text-3xl font-bold">
                Dashboard Overview
            </h2>

            <p class="text-gray-400 mt-2">
                Welcome back, {{ auth()->user()->name }}.
                Manage your professional portfolio here.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($statistics as $label => $value)

                <div class="dashboard-card rounded-xl p-6">
                    <p class="text-gray-400 text-sm uppercase tracking-wide">
                        {{ str_replace('_', ' ', $label) }}
                    </p>

                    <h3 class="text-4xl font-bold text-purple-400 mt-4">
                        {{ $value }}
                    </h3>
                </div>

            @endforeach

        </div>

        <div class="mt-10 dashboard-card rounded-xl p-7">
            <h3 class="text-xl font-semibold mb-3">
                Portfolio Management
            </h3>

            <p class="text-gray-400">
                Your administration area is now ready.
                We will add project, skill, experience,
                education, certification and message management next.
            </p>

            <a href="{{ route('home') }}"
               class="inline-block mt-6 text-purple-400 hover:text-purple-300">
                View Public Portfolio →
            </a>
        </div>

    </main>

</body>
</html>