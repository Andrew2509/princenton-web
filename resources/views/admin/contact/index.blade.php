@extends('admin.layouts.app')
@section('title', 'Inquiries')

@section('content')
{{-- Header --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Inquiries</h1>
    <div class="flex items-center gap-3">
        @if($unreadCount > 0)
        <form action="{{ route('admin.contact.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-lg">checklist</span>
                Mark all as read
            </button>
        </form>
        @endif
    </div>
</div>

@if(session('success'))
<div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-700 font-medium flex items-center gap-2">
    <span class="material-symbols-outlined text-lg">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Inquiries</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $totalCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">mail</span>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Unread Messages</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $unreadCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">mark_email_unread</span>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Replied</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $repliedCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">reply</span>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    {{-- Search & Filter --}}
    <div class="p-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.contact.index') }}" class="relative w-full md:w-96">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
            <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="Search inquiries..." type="text"/>
            @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}"/>
            @endif
        </form>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-500">Filter:</span>
                <form method="GET" action="{{ route('admin.contact.index') }}" id="filterForm">
                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}"/>
                    @endif
                    <select name="status" onchange="document.getElementById('filterForm').submit()" class="text-sm border-slate-200 rounded-lg focus:ring-accent/20 focus:border-accent">
                        <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    @if($messages->isEmpty())
    <div class="p-16 text-center">
        <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">inbox</span>
        <h3 class="text-lg font-bold text-slate-400">Belum ada pesan</h3>
        <p class="text-sm text-slate-400 mt-1">Pesan dari form kontak akan muncul di sini.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Sender</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Subject</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Date</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($messages as $msg)
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 {{ $msg->status === 'new' ? 'bg-accent/10 text-accent' : ($msg->status === 'archived' ? 'bg-slate-200 text-slate-600' : 'bg-slate-200 text-slate-600') }} rounded-full flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $msg->name)[1] ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $msg->name }}</p>
                                <p class="text-xs text-slate-500">{{ $msg->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-600 line-clamp-1">{{ $msg->subject ?: 'No subject' }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                        {{ $msg->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($msg->status === 'new')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">New</span>
                        @elseif($msg->status === 'replied')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Replied</span>
                        @elseif($msg->status === 'archived')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Archived</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.contact.show', $msg) }}" class="p-1.5 text-slate-400 hover:text-accent hover:bg-accent/5 rounded-lg transition-colors" title="View Detail">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </a>
                            @if($msg->status !== 'archived')
                            <form action="{{ route('admin.contact.archive', $msg) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" title="Archive">
                                    <span class="material-symbols-outlined text-xl">archive</span>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.contact.unarchive', $msg) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" title="Unarchive">
                                    <span class="material-symbols-outlined text-xl">unarchive</span>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.contact.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
        <p class="text-sm text-slate-500">
            Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} inquiries
        </p>
        {{ $messages->links() }}
    </div>
    @endif
    @endif
</div>
@endsection
