<!DOCTYPE html>
<html class="h-full" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Login | Portfolio Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1e293b",
                        "sidebar-blue": "#0f172a",
                        "accent": "#3b82f6",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px"}
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body { @apply font-display text-slate-900; }
        }
        .login-gradient {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
        }
    </style>
</head>
<body class="h-full flex items-center justify-center login-gradient p-6">
    <div class="w-full max-w-md">
        <div class="flex flex-col items-center mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-accent/20">JD</div>
                <h1 class="text-white font-bold text-2xl tracking-tight">Admin<span class="text-slate-500">Panel</span></h1>
            </div>
            <p class="text-slate-400 text-sm">Secure access to your portfolio management</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-8 md:p-10">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" class="space-y-6" method="POST">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                            <input class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" id="email" name="email" placeholder="name@example.com" required="" type="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-semibold text-slate-700" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                            <input class="w-full pl-11 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password'; this.children[0].textContent = p.type === 'password' ? 'visibility' : 'visibility_off'">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-accent focus:ring-accent border-slate-300 rounded cursor-pointer" id="remember" name="remember" type="checkbox"/>
                            <label class="ml-2 block text-sm text-slate-600 cursor-pointer select-none" for="remember">Remember me</label>
                        </div>
                    </div>
                    <button class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-accent hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all" type="submit">
                        <span class="material-symbols-outlined text-lg">login</span>
                        Sign In
                    </button>
                </form>
            </div>
            <div class="px-8 py-4 bg-slate-50 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} JD AdminPanel. All rights reserved.
                </p>
            </div>
        </div>
        <div class="mt-8 text-center">
            <a class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-medium" href="{{ url('/') }}">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Return to Portfolio Website
            </a>
        </div>
    </div>

    <!-- Vercel Speed Insights -->
    <script>
        window.si = window.si || function () { (window.siq = window.siq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/speed-insights/script.js"></script>
</body>
</html>
