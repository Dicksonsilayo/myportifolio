<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') | Dickson Silayo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --admin-bg: #080b16;
            --admin-sidebar: #0d1221;
            --admin-card: #111827;
            --admin-border: rgba(148, 163, 184, .13);
            --admin-purple: #a78bfa;
            --admin-blue: #38bdf8;
            --admin-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--admin-bg);
            color: #e5e7eb;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        .admin-sidebar {
            background: var(--admin-sidebar);
            border-right: 1px solid var(--admin-border);
            width: 270px;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .admin-brand {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -1px;
        }

        .admin-nav {
            flex: 1;
            overflow-y: auto;
            padding: 22px 16px;
        }

        .admin-nav::-webkit-scrollbar {
            width: 4px;
        }

        .admin-nav::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 10px;
            color: #9ca3af;
            font-size: 13px;
            font-weight: 600;
            transition: all .25s ease;
        }

        .nav-link i {
            width: 19px;
            text-align: center;
            font-size: 15px;
        }

        .nav-link:hover {
            background: rgba(139, 92, 246, .09);
            color: #c4b5fd;
        }

        .nav-link.active {
            background: linear-gradient(
                110deg,
                rgba(124, 58, 237, .22),
                rgba(37, 99, 235, .12)
            );
            color: #c4b5fd;
            border: 1px solid rgba(139, 92, 246, .17);
        }

        .nav-link.active i {
            color: #a78bfa;
        }

        .nav-heading {
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            padding: 15px;
            margin-top: 12px;
        }

        .admin-main {
            margin-left: 270px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            min-height: 85px;
            padding: 16px 35px;
            background: rgba(13, 18, 33, .85);
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(15px);
        }

        .admin-content {
            width: 100%;
            max-width: 1600px;
            margin: auto;
            padding: 35px;
            flex: 1;
        }

        .admin-card {
            background: var(--admin-card);
            border: 1px solid #263147;
            border-radius: 16px;
        }

        .form-input {
            width: 100%;
            background: #0b1120;
            border: 1px solid #374151;
            border-radius: 9px;
            padding: 12px 14px;
            color: #fff;
            outline: none;
            transition: .2s;
        }

        .form-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, .12);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: white;
            padding: 11px 19px;
            border-radius: 9px;
            font-weight: 700;
            font-size: 13px;
            transition: .25s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, .25);
        }

        .sidebar-overlay {
            display: none;
        }

        .mobile-menu-button {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--admin-border);
            border-radius: 9px;
            color: white;
            background: #111827;
            cursor: pointer;
        }

        .admin-footer {
            border-top: 1px solid var(--admin-border);
            padding: 20px 30px;
            text-align: center;
            color: #64748b;
            font-size: 11px;
        }

        .admin-user-avatar {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 12px;
            color: white;
            font-weight: 800;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
        }

        @media (max-width: 900px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 40;
                background: rgba(0, 0, 0, .65);
                backdrop-filter: blur(3px);
            }

            .mobile-menu-button {
                display: grid;
                place-items: center;
            }

            .admin-header {
                padding: 15px 20px;
            }

            .admin-content {
                padding: 25px 20px;
            }
        }

        @media (max-width: 600px) {
            .admin-content {
                padding: 20px 14px;
            }

            .admin-header {
                min-height: 72px;
                padding: 12px 14px;
            }

            .admin-header h1 {
                font-size: 17px;
            }

            .admin-header-description {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Mobile sidebar overlay --}}
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <div class="min-h-screen">

        {{-- =================================================
             SIDEBAR
        ================================================== --}}
        <aside id="adminSidebar" class="admin-sidebar">

            {{-- Branding --}}
            <div class="px-6 py-6 border-b border-gray-800">

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-brand text-xl font-extrabold">

                    <span class="text-white">DICKSON</span><span class="text-purple-400">.ADMIN</span>

                </a>

                <p class="text-xs text-gray-500 mt-2">
                    Portfolio Management System
                </p>

                <div class="mt-4 flex items-center gap-2">

                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>

                    <span class="text-xs text-green-400">
                        System Online
                    </span>

                </div>

            </div>


            {{-- Navigation --}}
            <nav class="admin-nav">

                <p class="nav-heading">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>

                </a>


                <p class="nav-heading">Portfolio Management</p>

                <a href="{{ route('admin.projects.index') }}"
                   class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">

                    <i class="fas fa-folder-open"></i>
                    <span>Projects</span>

                </a>

                <a href="{{ route('admin.skills.index') }}"
                   class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">

                    <i class="fas fa-code"></i>
                    <span>Skills</span>

                </a>

                <a href="{{ route('admin.experiences.index') }}"
                   class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">

                    <i class="fas fa-briefcase"></i>
                    <span>Experience</span>

                </a>

                <a href="{{ route('admin.education.index') }}"
                   class="nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">

                    <i class="fas fa-graduation-cap"></i>
                    <span>Education</span>

                </a>

                <a href="{{ route('admin.certifications.index') }}"
                   class="nav-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">

                    <i class="fas fa-award"></i>
                    <span>Certifications</span>

                </a>


                <p class="nav-heading">Communication</p>

                <a href="{{ route('admin.messages.index') }}"
                   class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">

                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>

                </a>


            

                <a href="{{ route('admin.profile.edit') }}"
                   class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">

                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>

                </a>

                <a href="{{ route('admin.account-settings.edit') }}"
   class="nav-link {{ request()->routeIs('admin.account-settings.*') ? 'active' : '' }}">

    <i class="fas fa-user-cog"></i>

    <span>Account Settings</span>

</a>


                <p class="nav-heading">Website</p>

                <a href="{{ route('home') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="nav-link">

                    <i class="fas fa-external-link-alt"></i>
                    <span>View Portfolio</span>

                </a>

            </nav>


            {{-- User information --}}
            <div class="p-4 border-t border-gray-800">

                <div class="flex items-center gap-3 mb-4">

                    <div class="admin-user-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <div class="min-w-0">

                        <p class="text-sm font-bold text-white truncate">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500 truncate">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>


                <form action="{{ route('admin.logout') }}" method="POST">

                    @csrf

                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 text-sm font-semibold hover:bg-red-500/10 transition">

                        <i class="fas fa-right-from-bracket"></i>

                        Logout

                    </button>

                </form>

            </div>

        </aside>


        {{-- =================================================
             MAIN CONTENT
        ================================================== --}}
        <main class="admin-main">

            {{-- Header --}}
            <header class="admin-header">

                <div class="flex items-center gap-4">

                    <button id="sidebarToggle"
                            type="button"
                            class="mobile-menu-button"
                            aria-label="Toggle navigation"
                            aria-controls="adminSidebar"
                            aria-expanded="false">

                        <i class="fas fa-bars"></i>

                    </button>

                    <div>

                        <h1 class="text-xl font-bold text-white">

                            @yield('page-heading', 'Dashboard')

                        </h1>

                        <p class="admin-header-description text-xs text-gray-500 mt-1">

                            Welcome to your portfolio management workspace.

                        </p>

                    </div>

                </div>


                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">

                        <p class="text-xs text-gray-400">
                            Logged in as
                        </p>

                        <p class="text-sm font-semibold text-white">
                            {{ auth()->user()->name }}
                        </p>

                    </div>

                    <div class="admin-user-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                </div>

            </header>


            {{-- Page Content --}}
            <div class="admin-content">


                {{-- Success notification --}}
                @if(session('success'))

                    <div class="mb-6 flex items-start gap-3 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-300">

                        <i class="fas fa-circle-check mt-1"></i>

                        <span>{{ session('success') }}</span>

                    </div>

                @endif


                {{-- General error notification --}}
                @if(session('error'))

                    <div class="mb-6 flex items-start gap-3 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-300">

                        <i class="fas fa-circle-exclamation mt-1"></i>

                        <span>{{ session('error') }}</span>

                    </div>

                @endif


                {{-- Validation errors --}}
                @if($errors->any())

                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-300">

                        <div class="flex items-center gap-2 mb-3 font-semibold">

                            <i class="fas fa-triangle-exclamation"></i>

                            Please correct the following errors:

                        </div>

                        <ul class="list-disc pl-6 space-y-1 text-sm">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                @yield('content')

            </div>


            {{-- Footer --}}
            <footer class="admin-footer">

                &copy; {{ date('Y') }} Dickson Silayo.
                Portfolio Management System.

            </footer>

        </main>

    </div>


    {{-- Mobile sidebar functionality --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('show');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.innerHTML = '<i class="fas fa-times"></i>';
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.innerHTML = '<i class="fas fa-bars"></i>';
                document.body.style.overflow = '';
            }

            toggle.addEventListener('click', function () {

                if (sidebar.classList.contains('open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }

            });

            overlay.addEventListener('click', closeSidebar);

            sidebar.querySelectorAll('.nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 900) {
                        closeSidebar();
                    }
                });
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 900) {
                    closeSidebar();
                }
            });

        });
    </script>

    @stack('scripts')

</body>
</html>