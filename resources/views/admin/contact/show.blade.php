@extends('admin.layouts.app')
@section('title', 'Inquiry Detail')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.contact.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 transition-colors mb-3">
                <span class="material-symbols-outlined text-xl">arrow_back</span>
                <span class="text-sm font-medium">Back to List</span>
            </a>
            <h1 class="text-2xl font-bold text-slate-900">Inquiry Detail</h1>
            <p class="text-slate-500 text-sm mt-1">Received on {{ $contact->created_at->format('F d, Y') }} at {{ $contact->created_at->format('g:i A') }}</p>
        </div>
        <div class="flex items-center gap-3">
            @if($contact->status === 'new')
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span>
                New Inquiry
            </span>
            @elseif($contact->status === 'replied')
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span>
                Replied
            </span>
            @elseif($contact->status === 'archived')
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-2"></span>
                Archived
            </span>
            @endif

            @if($contact->status !== 'archived')
            <form action="{{ route('admin.contact.archive', $contact) }}" method="POST" class="inline">
                @csrf @method('PUT')
                <button type="submit" class="p-2 text-slate-400 hover:text-slate-600 transition-colors" title="Archive">
                    <span class="material-symbols-outlined">archive</span>
                </button>
            </form>
            @else
            <form action="{{ route('admin.contact.unarchive', $contact) }}" method="POST" class="inline">
                @csrf @method('PUT')
                <button type="submit" class="p-2 text-slate-400 hover:text-slate-600 transition-colors" title="Unarchive">
                    <span class="material-symbols-outlined">unarchive</span>
                </button>
            </form>
            @endif

            <form action="{{ route('admin.contact.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Delete">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Message Card --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        {{-- Sender --}}
        <div class="p-6 border-b border-slate-100 bg-slate-50/30">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center text-slate-600 font-bold text-lg">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $contact->name)[1] ?? '', 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-900">{{ $contact->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="mailto:{{ $contact->email }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors" title="Send Email">
                        <span class="material-symbols-outlined text-lg">alternate_email</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-8">
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Subject</h3>
                <p class="text-lg font-semibold text-slate-800 mt-1">{{ $contact->subject ?: 'No subject' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Message Content</h3>
                <div class="mt-4 prose prose-slate max-w-none text-slate-700 leading-relaxed bg-slate-50 p-6 rounded-xl border border-slate-100">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Reply --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Quick Reply</h3>
        </div>
        <div class="p-6 space-y-4">
            <div class="relative">
                <textarea id="replyMessage" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none resize-none" placeholder="Write your reply here..." rows="6">Dear {{ explode(' ', $contact->name)[0] }},

Thank you for reaching out.



Best regards</textarea>
            </div>
            <div class="flex items-center justify-end">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Your message') }}" id="sendReplyBtn" onclick="this.href = this.href.split('&body=')[0] + '&body=' + encodeURIComponent(document.getElementById('replyMessage').value)" class="px-6 py-2 bg-accent text-white font-semibold rounded-lg hover:bg-accent/90 transition-colors shadow-sm flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-lg">send</span>
                    Send Reply
                </a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-sm text-slate-500">
        <p>This inquiry will be automatically archived after 30 days of inactivity.</p>
    </div>
</div>
@endsection
