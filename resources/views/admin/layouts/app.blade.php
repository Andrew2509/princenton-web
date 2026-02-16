<!DOCTYPE html>
<html class="" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Panel') | Portfolio Management</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="/_vercel/speed-insights/script.js"></script>
    <script>
        window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/insights/script.js"></script>
</head>
<body class="flex h-screen overflow-hidden">

{{-- Sidebar --}}
<aside class="w-64 bg-sidebar-blue text-slate-300 flex flex-col shrink-0">
    <div class="p-6 flex items-center gap-3">
        <div class="w-8 h-8 bg-accent rounded flex items-center justify-center text-white font-bold">AP</div>
        <span class="text-white font-bold text-lg tracking-tight">Admin<span class="text-slate-500">Panel</span></span>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-1">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}">Dashboard</span>
        </a>
        <a class="{{ request()->routeIs('admin.projects.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.projects.index') }}">
            <span class="material-symbols-outlined text-xl">work</span>
            <span class="font-medium {{ request()->routeIs('admin.projects.*') ? 'text-white' : '' }}">Projects</span>
        </a>
        <a class="{{ request()->routeIs('admin.skills.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.skills.index') }}">
            <span class="material-symbols-outlined text-xl">psychology</span>
            <span class="font-medium {{ request()->routeIs('admin.skills.*') ? 'text-white' : '' }}">Skills</span>
        </a>
        <a class="{{ request()->routeIs('admin.methodology.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.methodology.index') }}">
            <span class="material-symbols-outlined text-xl">account_tree</span>
            <span class="font-medium {{ request()->routeIs('admin.methodology.*') ? 'text-white' : '' }}">Methodology</span>
        </a>
        <a class="{{ request()->routeIs('admin.about.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.about.edit') }}">
            <span class="material-symbols-outlined text-xl">person</span>
            <span class="font-medium {{ request()->routeIs('admin.about.*') ? 'text-white' : '' }}">About Me</span>
        </a>
        <a class="{{ request()->routeIs('admin.contact.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.contact.index') }}">
            <span class="material-symbols-outlined text-xl">mail</span>
            <span class="font-medium {{ request()->routeIs('admin.contact.*') ? 'text-white' : '' }}">Inquiries</span>
            @php $unreadMsgCount = \App\Models\ContactMessage::where('status', 'new')->count(); @endphp
            @if($unreadMsgCount > 0)
                <span class="ml-auto px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[20px] text-center">{{ $unreadMsgCount }}</span>
            @endif
        </a>
        <div class="pt-4 mt-4 border-t border-white/10">
            <a class="{{ request()->routeIs('admin.settings.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" href="{{ route('admin.settings.edit') }}">
                <span class="material-symbols-outlined text-xl">settings</span>
                <span class="font-medium {{ request()->routeIs('admin.settings.*') ? 'text-white' : '' }}">Settings</span>
            </a>
        </div>
    </nav>
    <div class="p-4 border-t border-white/10 bg-black/20">
        <div class="flex items-center gap-3">
            @if(auth()->user()->avatar_url)
                <img src="{{ auth()->user()->avatar_url }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white/10">
            @else
                <div class="w-10 h-10 rounded-full bg-accent/30 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            @endif
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</aside>

{{-- Main Content --}}
<main class="flex-1 flex flex-col min-w-0 bg-slate-50">
    {{-- Header --}}
    <header class="h-16 bg-white border-b border-slate-200 px-8 flex items-center justify-between shrink-0">
        <div class="flex items-center gap-4 w-1/3">
            <div class="relative w-full max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-slate-100 border-none rounded-lg text-sm focus:ring-2 focus:ring-accent/20" placeholder="Search dashboard..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="/" target="_blank" class="text-slate-400 hover:text-slate-600 flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-lg">open_in_new</span>
                View Site
            </a>
            <div class="h-8 w-px bg-slate-200"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-slate-400 hover:text-red-500 transition-colors text-sm font-medium">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </header>

    {{-- Content Area --}}
    <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
        <div class="max-w-7xl mx-auto">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-xl">check_circle</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-xl">error</span>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-xl">error</span>
                        <span class="font-medium">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</main>

    <script>
        window.siteConfig = {
            contactEmail: "{{ \App\Models\SiteSetting::get('contact_email', 'admin@example.com') }}"
        };
    </script>
    <script src="{{ asset('admin/js/auto_translate.js') }}?v={{ time() }}"></script>
</body>
</html>
