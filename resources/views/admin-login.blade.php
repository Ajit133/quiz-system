<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Space+Grotesk:wght@500;700&display=swap');

        :root {
            --page-bg: #ecf4ea;
            --frame-bg: #f6faf2;
            --hero-bg: #45bb67;
            --hero-bg-dark: #33a958;
            --ink: #06110b;
            --ink-soft: #244437;
            --line: rgba(9, 27, 17, 0.14);
            --accent: #45bb67;
            --accent-dark: #33a958;
            --white: #ffffff;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(180deg, var(--hero-bg), var(--hero-bg-dark));
            color: var(--ink);
        }

        .admin-heading {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-6">

    <div class="w-full max-w-md">

        {{-- Logo / Branding --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-500 rounded-2xl shadow-lg shadow-emerald-900/20 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h1 class="admin-heading text-3xl font-bold text-[#06110b] tracking-tight">Quiz System</h1>
            <p class="text-[#244437] text-sm mt-1 font-semibold">Administration Panel</p>
        </div>

        {{-- Card --}}
        <div class="bg-[#f6faf2]/95 backdrop-blur-sm border border-[#d2e8cc] rounded-2xl shadow-2xl shadow-emerald-900/10 p-8">

            <h2 class="admin-heading text-xl font-semibold text-[#06110b] mb-1">Welcome back</h2>
            <p class="text-[#244437] text-sm mb-7">Sign in to access your admin dashboard</p>

             @error('user')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

            <form action="/admin-login" method="POST" class="space-y-5">
                @csrf

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm font-semibold text-[#1a3a2a] mb-1.5">
                        Username
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-emerald-700/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input
                            id="username"
                            type="text"
                            name="name"
                            placeholder="Enter your username"
                            autocomplete="username"
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#cfe3c8] text-[#163724] placeholder-[#6d8b7a] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                        />
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-[#1a3a2a] mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-emerald-700/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#cfe3c8] text-[#163724] placeholder-[#6d8b7a] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                        />
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Remember me --}}
                {{-- <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 bg-white/10 accent-blue-500" />
                        <span class="text-sm text-slate-400">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition">Forgot password?</a>
                </div> --}}

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-2.5 px-4 bg-[#45bb67] hover:bg-[#3cae5f] active:bg-[#33a958] text-white font-semibold rounded-xl text-sm shadow-lg shadow-emerald-900/20 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-transparent"
                >
                    Sign In
                </button>

            </form>
        </div>

        <p class="text-center text-[#335846] text-xs mt-6">&copy; {{ date('Y') }} Quiz System. All rights reserved.</p>
    </div>

</body>
</html>
