<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin Panel' }} | Dickson Silayo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #080b16;
            color: #e5e7eb;
        }

        .sidebar {
            background: #0d1221;
            border-right: 1px solid #20283a;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #9ca3af;
            transition: all .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #202844;
            color: #ffffff;
        }

        .admin-card {
            background: #111827;
            border: 1px solid #263147;
            border-radius: 14px;
        }

        .form-input {
            width: 100%;
            background: #0b1120;
            border: 1px solid #374151;
            border-radius: 9px;
            padding: 11px 13px;
            color: #ffffff;
            outline: none;
        }

        .form-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 2px rgba(139, 92, 246, .15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: white;
            padding: 11px 18px;
            border-radius: 9px;
            font-weight: 600;
            transition: opacity .2s;
        }

        .btn-primary:hover {
            opacity: .85;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="min-h-screen md:flex">

        {{-- Sidebar --}}
        <aside class="sidebar w-full md:w-64 md:min-h-screen md:fixed md:inset-y-0">

            <div class="p-6 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-extrabold tracking-wide">
                    <span class="text-white">DICKSON</span>
                    <span class="text-purple-400">.ADMIN</span>
                </a>

                <p class="text-xs text-gray-500 mt-2">
                    Portfolio Management System
                </p>
            </div>

            <nav class="p-4 space-y-2">

                <p class="text-xs uppercase tracking-wider text-gray-500 px-4 py-3">
                    Main Menu
                </p>

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>▦</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <span>▣</span>
                    <span>Projects</span>
                </a>
                <a href="{{ route('admin.skills.index') }}"
                    class="nav-link {{ request()->routeIs('admin.skills.*') ? 'bg-purple-600/20 text-purple-400' : '' }}">
                    <span>⚙</span>
                    Skills
                </a>
                <a href="{{ route('admin.experiences.index') }}"
                    class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'bg-purple-600/20 text-purple-400' : '' }}">
                    <span>⚙</span>
                    Experience
                </a>
                <p class="text-xs uppercase tracking-wider text-gray-500 px-4 py-3 mt-5">
                    Website
                </p>

                <a href="{{ route('home') }}" target="_blank" class="nav-link">
                    <span>↗</span>
                    <span>View Portfolio</span>
                </a>

            </nav>

            <div class="p-4 md:absolute md:bottom-0 md:left-0 md:right-0">
                <div class="border-t border-gray-800 pt-4">

                    <p class="text-sm text-gray-400 mb-3">
                        Logged in as
                    </p>

                    <p class="font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500 mb-4">
                        {{ auth()->user()->email }}
                    </p>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="w-full text-left px-4 py-2 rounded-lg text-red-400 hover:bg-red-500/10">
                            ↪ Logout
                        </button>
                    </form>

                </div>
            </div>

        </aside>

        {{-- Main Content --}}
        <main class="flex-1 min-w-0 md:ml-64">

            <header class="bg-gray-900/70 border-b border-gray-800 px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold text-white">
                            @yield('page-heading', 'Dashboard')
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Manage your professional portfolio.
                        </p>
                    </div>

                    <span
                        class="hidden sm:inline-block text-xs bg-purple-500/10 text-purple-300 px-3 py-2 rounded-full">
                        Administrator
                    </span>
                </div>
            </header>

            <div class="p-5 md:p-8">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/30 text-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- General Error Message --}}
                @if (session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/30 text-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/30 text-red-300">
                        <p class="font-semibold mb-2">Please correct these errors:</p>

                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </div>

            <footer class="border-t border-gray-800 px-6 py-5 text-center text-xs text-gray-600">
                &copy; {{ date('Y') }} Dickson Silayo. Admin Panel.
            </footer>

        </main>

    </div>

    @stack('scripts')

</body>

</html>
