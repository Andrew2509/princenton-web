@extends('admin.layouts.app')
@section('title', 'Manage Skills & Tech Stack')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Manage Skills & Tech Stack</h1>
        <p class="text-slate-500 text-sm mt-1">Configure the technologies displayed in your portfolio's marquee.</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="bg-accent text-white px-6 py-2.5 rounded-lg font-semibold flex items-center gap-2 hover:bg-blue-600 transition-all shadow-md shadow-accent/20">
        <span class="material-symbols-outlined text-lg">add</span>
        Add New Skill
    </a>
</div>

{{-- Skills Card Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @php
        $iconColors = [
            'Frontend' => ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-500'],
            'Backend' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-500'],
            'Design' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-500'],
            'DevOps' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-500'],
            'Mobile' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'],
            'primary' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'],
            'secondary' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-500'],
        ];
    @endphp

    @foreach($skills as $skill)
    @php
        $colors = $iconColors[$skill->category] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-500'];
    @endphp
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 {{ $colors['bg'] }} rounded-xl flex items-center justify-center overflow-hidden">
                @if($skill->icon_url)
                    <img src="{{ $skill->icon_url }}" alt="{{ $skill->name }}" class="w-8 h-8 object-contain"/>
                @else
                    <span class="material-symbols-outlined {{ $colors['text'] }} text-2xl">{{ $skill->icon ?? 'code' }}</span>
                @endif
            </div>
            <div class="flex flex-col items-end">
                <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="inline toggle-form">
                    @csrf @method('PUT')
                    <input type="hidden" name="name" value="{{ $skill->name }}"/>
                    <input type="hidden" name="icon" value="{{ $skill->icon }}"/>
                    <input type="hidden" name="category" value="{{ $skill->category }}"/>
                    <input type="hidden" name="proficiency" value="{{ $skill->proficiency }}"/>
                    <input type="hidden" name="sort_order" value="{{ $skill->sort_order }}"/>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input name="is_active" type="checkbox" value="1" {{ $skill->is_active ? 'checked' : '' }} class="sr-only peer" onchange="this.form.submit()"/>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                    </label>
                </form>
                <span class="text-[10px] font-bold text-slate-400 mt-1 uppercase">{{ $skill->is_active ? 'Active' : 'Inactive' }}</span>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-slate-900 text-lg">{{ $skill->name }}</h3>
            <p class="text-xs text-slate-500 mt-1 italic">{{ $skill->category }}</p>
        </div>
        <div class="mt-6 flex items-center justify-between pt-4 border-t border-slate-50">
            <span class="text-[10px] font-medium text-slate-400">Added {{ $skill->created_at->format('M d, Y') }}</span>
            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="p-1.5 text-slate-400 hover:text-accent rounded-md hover:bg-slate-50">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </a>
                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline" onsubmit="return confirm('Delete this skill?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 rounded-md hover:bg-slate-50">
                        <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Add New Card --}}
    <a href="{{ route('admin.skills.create') }}" class="border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center p-6 bg-slate-50/50 hover:bg-slate-100 hover:border-slate-300 transition-all cursor-pointer group min-h-[200px]">
        <div class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
            <span class="material-symbols-outlined text-slate-400 group-hover:text-accent">add</span>
        </div>
        <p class="text-sm font-bold text-slate-500 group-hover:text-slate-700">Add New Technology</p>
        <p class="text-xs text-slate-400 text-center mt-1 px-4">Specify icon and technology name</p>
    </a>
</div>
@endsection
