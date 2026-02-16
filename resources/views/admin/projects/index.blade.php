@extends('admin.layouts.app')
@section('title', 'Project Management')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Project Management</h1>
        <p class="text-slate-500 text-sm mt-1">Add, edit, and manage your portfolio case studies.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="bg-accent text-white px-6 py-2.5 rounded-lg font-semibold flex items-center gap-2 hover:bg-blue-600 transition-all shadow-md shadow-accent/20">
        <span class="material-symbols-outlined text-lg">add</span>
        Add New Project
    </a>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Total Projects</span>
            <span class="p-2 bg-blue-50 text-accent rounded-lg">
                <span class="material-symbols-outlined text-xl">folder</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $totalProjects }}</p>
        <p class="text-xs text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">trending_up</span>
            All portfolio projects
        </p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Drafts</span>
            <span class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                <span class="material-symbols-outlined text-xl">edit_note</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $draftProjects }}</p>
        <p class="text-xs text-slate-400 font-medium mt-2">Requires review</p>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-slate-500 text-sm font-medium">Published</span>
            <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                <span class="material-symbols-outlined text-xl">visibility</span>
            </span>
        </div>
        <p class="text-3xl font-bold">{{ $publishedProjects }}</p>
        <p class="text-xs text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">check_circle</span>
            Live on portfolio
        </p>
    </div>
</div>

{{-- Projects Table --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Current Projects</h3>
        <div class="flex items-center gap-2">
            <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-xl">filter_list</span>
            </button>
            <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-xl">sort</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Project Details</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Last Updated</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($projects as $project)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-slate-200 overflow-hidden shrink-0">
                                    @php
                                        $isSafeUrl = $project->image_url &&
                                                   (Str::startsWith($project->image_url, ['http://', 'https://', '/', 'data:']) &&
                                                   !Str::startsWith($project->image_url, 'file:'));
                                    @endphp
                                @if($isSafeUrl)
                                <img alt="{{ $project->title }}" class="w-full h-full object-cover" src="{{ $project->image_url }}"/>
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                    <span class="material-symbols-outlined text-slate-400">image</span>
                                </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ $project->title }}</p>
                                <p class="text-xs text-slate-500">{{ $project->role ?? 'No role specified' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $categories = explode(' ', trim($project->category));
                            $catColors = [
                                'development' => 'bg-blue-100 text-blue-700',
                                'ui-ux' => 'bg-purple-100 text-purple-700',
                                'saas' => 'bg-teal-100 text-teal-700',
                                'design' => 'bg-pink-100 text-pink-700',
                            ];
                            $primaryCat = $categories[0] ?? 'other';
                            $colorClass = $catColors[$primaryCat] ?? 'bg-slate-100 text-slate-600';
                        @endphp
                        <span class="px-2.5 py-1 {{ $colorClass }} text-[10px] font-bold uppercase rounded-full">{{ str_replace('-', '/', $primaryCat) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if($project->status === 'published')
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-sm font-medium text-slate-700">Published</span>
                            @elseif($project->status === 'draft')
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span class="text-sm font-medium text-slate-700">Draft</span>
                            @elseif($project->status === 'completed')
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-sm font-medium text-slate-700">Completed</span>
                            @else
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span class="text-sm font-medium text-slate-700">{{ ucfirst($project->status) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $project->updated_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-slate-400 hover:text-accent hover:bg-blue-50 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2">folder_off</span>
                        <p class="text-sm">No projects found. Create your first project!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Footer --}}
    @if($projects->total() > 0)
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
        <p class="text-xs text-slate-500 font-medium">
            Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} projects
        </p>
        <div class="flex gap-2">
            @if($projects->onFirstPage())
            <span class="px-3 py-1 bg-white border border-slate-200 text-slate-300 text-xs font-bold rounded cursor-not-allowed">Previous</span>
            @else
            <a href="{{ $projects->previousPageUrl() }}" class="px-3 py-1 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded hover:bg-slate-50 transition-colors">Previous</a>
            @endif

            @if($projects->hasMorePages())
            <a href="{{ $projects->nextPageUrl() }}" class="px-3 py-1 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded hover:bg-slate-50 transition-colors">Next</a>
            @else
            <span class="px-3 py-1 bg-white border border-slate-200 text-slate-300 text-xs font-bold rounded cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
