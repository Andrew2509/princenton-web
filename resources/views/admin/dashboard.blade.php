@extends('admin.layouts.app')

@section('title', 'Dashboard Summary')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Summary</h1>
    <p class="text-slate-500 text-sm mt-1">Overview of your portfolio's performance and content status.</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Total Projects</span>
            <span class="p-2 bg-blue-50 text-accent rounded-lg">
                <span class="material-symbols-outlined text-xl">folder</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $totalProjects }}</p>
        <a href="{{ route('admin.projects.index') }}" class="text-xs text-accent font-medium mt-2 flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-xs">arrow_forward</span>
            Manage Projects
        </a>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Total Skills</span>
            <span class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                <span class="material-symbols-outlined text-xl">psychology</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $totalSkills }}</p>
        <a href="{{ route('admin.skills.index') }}" class="text-xs text-accent font-medium mt-2 flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-xs">arrow_forward</span>
            Manage Skills
        </a>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Methodology Steps</span>
            <span class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                <span class="material-symbols-outlined text-xl">account_tree</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $totalSteps }}</p>
        <a href="{{ route('admin.methodology.index') }}" class="text-xs text-accent font-medium mt-2 flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-xs">arrow_forward</span>
            Manage Steps
        </a>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Site Status</span>
            <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                <span class="material-symbols-outlined text-xl">visibility</span>
            </span>
        </div>
        <p class="text-3xl font-bold flex items-center gap-2">
            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
            Online
        </p>
        <p class="text-xs text-slate-400 font-medium mt-2">Portfolio is live</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        {{-- Recent Projects --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Recent Projects</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-accent hover:underline">View All</a>
            </div>
            <div class="p-6">
                @if($recentProjects->count() > 0)
                <div class="flow-root">
                    <ul class="-mb-8">
                        @foreach($recentProjects as $project)
                        <li>
                            <div class="relative {{ !$loop->last ? 'pb-8' : '' }}">
                                @if(!$loop->last)
                                <span aria-hidden="true" class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-slate-200"></span>
                                @endif
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center ring-8 ring-white">
                                            <span class="material-symbols-outlined text-blue-600 text-xl">folder</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div>
                                            <div class="text-sm font-bold text-slate-900">{{ $project->title }}</div>
                                            <p class="mt-0.5 text-xs text-slate-500">{{ $project->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="mt-2 text-sm text-slate-600">
                                            <p>{{ $project->role ?? 'No role specified' }} · {{ $project->tools ?? 'No tools specified' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="text-center py-8 text-slate-400">
                    <span class="material-symbols-outlined text-4xl mb-2">folder_off</span>
                    <p class="text-sm">No projects yet. Create your first project!</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.projects.create') }}" class="w-full flex items-center gap-3 p-3 bg-slate-50 hover:bg-accent/5 hover:text-accent rounded-lg text-slate-700 font-medium transition-all group border border-slate-100">
                    <span class="material-symbols-outlined text-xl bg-white p-1.5 rounded-md shadow-sm group-hover:bg-accent group-hover:text-white transition-colors">add</span>
                    <span>Add New Project</span>
                </a>
                <a href="{{ route('admin.about.edit') }}" class="w-full flex items-center gap-3 p-3 bg-slate-50 hover:bg-accent/5 hover:text-accent rounded-lg text-slate-700 font-medium transition-all group border border-slate-100">
                    <span class="material-symbols-outlined text-xl bg-white p-1.5 rounded-md shadow-sm group-hover:bg-accent group-hover:text-white transition-colors">person_edit</span>
                    <span>Edit About Me</span>
                </a>
                <a href="{{ route('admin.methodology.index') }}" class="w-full flex items-center gap-3 p-3 bg-slate-50 hover:bg-accent/5 hover:text-accent rounded-lg text-slate-700 font-medium transition-all group border border-slate-100">
                    <span class="material-symbols-outlined text-xl bg-white p-1.5 rounded-md shadow-sm group-hover:bg-accent group-hover:text-white transition-colors">history_edu</span>
                    <span>Review Methodology</span>
                </a>
                <a href="{{ route('admin.skills.create') }}" class="w-full flex items-center gap-3 p-3 bg-slate-50 hover:bg-accent/5 hover:text-accent rounded-lg text-slate-700 font-medium transition-all group border border-slate-100">
                    <span class="material-symbols-outlined text-xl bg-white p-1.5 rounded-md shadow-sm group-hover:bg-accent group-hover:text-white transition-colors">add_circle</span>
                    <span>Add New Skill</span>
                </a>
            </div>
        </div>

        {{-- System Status --}}
        <div class="bg-primary text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">System Status</p>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="font-bold">Site is Online</span>
                </div>
                <p class="text-xs text-slate-400">Your portfolio is currently live and accessible to visitors.</p>
            </div>
            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-white/5 text-8xl">public</span>
        </div>
    </div>
</div>
@endsection
