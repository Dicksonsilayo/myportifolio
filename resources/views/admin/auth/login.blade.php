<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Dickson Silayo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #080b14;
            font-family: Arial, sans-serif;
        }

        .login-card {
            background: #111827;
            border: 1px solid #263247;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-5">

    <div class="login-card w-full max-w-md rounded-2xl p-8 shadow-2xl">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">
                DS<span class="text-purple-500">.</span>
            </h1>

            <h2 class="text-xl font-semibold text-white mt-5">
                Administrator Login
            </h2>

            <p class="text-gray-400 text-sm mt-2">
                Sign in to manage your portfolio.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30
                        text-red-400 rounded-lg p-3 mb-5 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-gray-300 mb-2 text-sm">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg bg-gray-900 border border-gray-700
                           text-white px-4 py-3 focus:outline-none
                           focus:border-purple-500"
                    placeholder="admin@example.com"
                >
            </div>

            <div class="mb-5">
                <label class="block text-gray-300 mb-2 text-sm">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-lg bg-gray-900 border border-gray-700
                           text-white px-4 py-3 focus:outline-none
                           focus:border-purple-500"
                    placeholder="Enter your password"
                >
            </div>

            <div class="flex items-center mb-6">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    class="mr-2"
                >

                <label class="text-gray-400 text-sm">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700
                       text-white font-semibold rounded-lg py-3 transition">
                Sign In
            </button>
        </form>

        <div class="text-center mt-7">
            <a href="{{ route('home') }}"
               class="text-gray-400 hover:text-purple-400 text-sm">
                ← Back to portfolio
            </a>
        </div>

    </div>

</body>
</html>