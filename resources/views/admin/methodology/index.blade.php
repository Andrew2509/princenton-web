@extends('admin.layouts.app')
@section('title', 'Methodology Editor')

@section('content')
<style type="text/tailwindcss">
    .timeline-line {
        @apply absolute left-6 top-8 bottom-0 w-0.5 bg-slate-200;
    }
    .timeline-step:last-child .timeline-line {
        @apply hidden;
    }
</style>

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Methodology Editor</h1>
    <p class="text-slate-500 text-sm mt-1">Configure the STAR framework stages for your portfolio's process section.</p>
</div>

@if(session('success'))
<div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-700 font-medium flex items-center gap-2">
    <span class="material-symbols-outlined text-lg">check_circle</span>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Column - Stage Cards --}}
    <div class="lg:col-span-2 space-y-6">
        <form id="bulk-form" action="{{ route('admin.methodology.bulkUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            @foreach($steps as $index => $step)
            <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden {{ !$loop->first ? 'mt-6' : '' }}">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-blue-100 text-accent flex items-center justify-center font-bold text-sm">{{ $step->phase_number }}</span>
                        <h2 class="font-bold text-slate-800 tracking-tight">Stage: <span class="stage-title-label">{{ $step->title }}</span></h2>
                    </div>
                    <div class="flex items-center gap-1">
                        <button type="button" onclick="deleteStage({{ $step->id }})" class="p-1.5 text-slate-400 hover:text-red-500 rounded-md hover:bg-red-50 transition-colors" title="Delete stage">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                        <span class="material-symbols-outlined text-slate-400 cursor-move">drag_indicator</span>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5 flex-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Title (EN)</label>
                            <input name="steps[{{ $step->id }}][title]" value="{{ $step->title }}" class="w-full rounded-lg border-slate-200 focus:border-accent focus:ring-accent/20 text-sm font-medium" type="text" data-translate-target="title-id-{{ $step->id }}" oninput="this.closest('section').querySelector('.stage-title-label').textContent = this.value; updatePreview()"/>
                        </div>
                        <div class="space-y-1.5 flex-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Title (ID)</label>
                            <input id="title-id-{{ $step->id }}" name="steps[{{ $step->id }}][title_id]" value="{{ $step->title_id }}" class="w-full rounded-lg border-slate-100 focus:border-accent focus:ring-accent/20 text-sm font-medium" type="text" placeholder="Judul bahasa Indonesia" oninput="updatePreview()"/>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500 uppercase">Icon</label>
                            <div class="flex gap-2">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 border border-slate-200 icon-preview-box">
                                    <span class="material-symbols-outlined icon-preview-span">{{ $step->icon ?? 'star' }}</span>
                                </div>
                                <input name="steps[{{ $step->id }}][icon]" value="{{ $step->icon ?? 'star' }}" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-600 focus:border-accent focus:ring-accent/20 outline-none" type="text" placeholder="Material icon name" oninput="this.parentElement.querySelector('.icon-preview-span').textContent = this.value; updatePreview()"/>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Description (EN)</label>
                            <textarea name="steps[{{ $step->id }}][description]" class="w-full rounded-lg border-slate-200 focus:border-accent focus:ring-accent/20 text-sm" rows="3" data-translate-target="desc-id-{{ $step->id }}" oninput="updatePreview()">{{ $step->description }}</textarea>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Description (ID)</label>
                            <textarea id="desc-id-{{ $step->id }}" name="steps[{{ $step->id }}][description_id]" class="w-full rounded-lg border-slate-100 focus:border-accent focus:ring-accent/20 text-sm" rows="3" placeholder="Deskripsi bahasa Indonesia" oninput="updatePreview()">{{ $step->description_id }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-1.5 pt-2">
                        <label class="text-xs font-bold text-slate-500 uppercase">Stage Image</label>
                        <div class="flex gap-2 mb-2">
                            <button type="button" onclick="toggleBulkImageMode(this, 'upload')" class="bulk-img-mode-btn text-[10px] font-bold px-2.5 py-1 rounded-full border border-accent bg-accent/10 text-accent">Upload</button>
                            <button type="button" onclick="toggleBulkImageMode(this, 'url')" class="bulk-img-mode-btn text-[10px] font-bold px-2.5 py-1 rounded-full border border-slate-200 text-slate-400 hover:border-slate-300">URL</button>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-lg bg-slate-50 border border-slate-200 overflow-hidden shrink-0 relative group">
                                <img src="{{ $step->image_url ?? '' }}" class="w-full h-full object-cover stage-img-preview {{ isset($step->image_url) ? '' : 'hidden' }}"/>
                                <div class="absolute inset-0 flex items-center justify-center placeholder-icon {{ isset($step->image_url) ? 'hidden' : '' }}">
                                    <span class="material-symbols-outlined text-slate-300">image</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="bulk-upload-mode">
                                    <input name="steps[{{ $step->id }}][image]" class="block w-full text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer" type="file" onchange="previewBulkImage(this)"/>
                                    <p class="text-[10px] text-slate-400 mt-1">Recommended: 800x450px aspect ratio</p>
                                </div>
                                <div class="bulk-url-mode hidden">
                                    <input name="steps[{{ $step->id }}][image_url]" value="{{ $step->image_url ?? '' }}" class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" type="text" placeholder="https://example.com/image.jpg" oninput="previewBulkUrl(this)"/>
                                    <p class="text-[10px] text-slate-400 mt-1">Paste an external image URL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endforeach
        </form>

        {{-- Add New Stage --}}
        <a href="{{ route('admin.methodology.create') }}" class="border-2 border-dashed border-slate-200 rounded-xl flex items-center justify-center p-8 bg-slate-50/50 hover:bg-slate-100 hover:border-slate-300 transition-all cursor-pointer group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-accent">add</span>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500 group-hover:text-slate-700">Add New Stage</p>
                    <p class="text-xs text-slate-400">Add another step to your methodology</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Right Column - Live Preview + Tips --}}
    <div class="lg:col-span-1 self-start sticky top-0">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <h3 class="font-bold text-slate-800">Live Preview</h3>
                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase rounded">Public View</span>
            </div>
            <div class="p-6">
                <div id="preview-container" class="relative space-y-8">
                    {{-- Preview items rendered by JS --}}
                </div>
                <div class="mt-8 pt-6 border-t border-slate-100">
                    <a href="/" target="_blank" class="w-full py-2.5 rounded-lg border-2 border-slate-100 text-slate-500 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                        Preview Landing Page
                    </a>
                </div>
            </div>
        </div>

        {{-- Pro Tip --}}
        <div class="mt-6 bg-amber-50 border border-amber-200 p-4 rounded-xl">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-amber-600">lightbulb</span>
                <div>
                    <p class="text-sm font-bold text-amber-800">Pro Tip</p>
                    <p class="text-xs text-amber-700 mt-0.5">Keep descriptions under 150 characters for better visibility on mobile screens.</p>
                </div>
            </div>
        </div>

        {{-- Publish Button --}}
        <div class="mt-6">
            <button type="submit" form="bulk-form" class="w-full bg-accent text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-600 transition-all shadow-lg shadow-accent/25 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-lg">save</span>
                Publish Changes
            </button>
        </div>
    </div>
</div>

{{-- Hidden delete forms (outside bulk form to avoid nesting) --}}
@foreach($steps as $step)
<form id="delete-form-{{ $step->id }}" action="{{ route('admin.methodology.destroy', $step) }}" method="POST" class="hidden">
    @csrf @method('DELETE')
</form>
@endforeach

<script>
    function deleteStage(id) {
        if (!confirm('Are you sure you want to delete this stage? This cannot be undone.')) return;
        document.getElementById('delete-form-' + id).submit();
    }

    function previewBulkImage(input) {
        const section = input.closest('section');
        const preview = section.querySelector('.stage-img-preview');
        const placeholder = section.querySelector('.placeholder-icon');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                updatePreview();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewBulkUrl(input) {
        const section = input.closest('section');
        const preview = section.querySelector('.stage-img-preview');
        const placeholder = section.querySelector('.placeholder-icon');
        const url = input.value.trim();
        if (url) {
            preview.src = url;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
        updatePreview();
    }

    function toggleBulkImageMode(btn, mode) {
        // Find the parent container for this stage's image section
        const wrapper = btn.parentElement.parentElement;

        // Update button styles
        wrapper.querySelectorAll('.bulk-img-mode-btn').forEach(b => {
            b.classList.remove('border-accent', 'bg-accent/10', 'text-accent');
            b.classList.add('border-slate-200', 'text-slate-400');
        });
        btn.classList.remove('border-slate-200', 'text-slate-400');
        btn.classList.add('border-accent', 'bg-accent/10', 'text-accent');

        // Toggle modes
        const uploadDiv = wrapper.querySelector('.bulk-upload-mode');
        const urlDiv = wrapper.querySelector('.bulk-url-mode');

        if (mode === 'url') {
            if (uploadDiv) uploadDiv.classList.add('hidden');
            if (urlDiv) urlDiv.classList.remove('hidden');
        } else {
            if (uploadDiv) uploadDiv.classList.remove('hidden');
            if (urlDiv) urlDiv.classList.add('hidden');
        }
    }

    function updatePreview() {
        const container = document.getElementById('preview-container');
        const sections = document.querySelectorAll('#bulk-form section');
        let html = '';

        sections.forEach((section, index) => {
            const titleInput = section.querySelector('input[name*="[title]"]');
            const iconInput = section.querySelector('input[name*="[icon]"]');
            const descTextarea = section.querySelector('textarea');
            const imgPreview = section.querySelector('.stage-img-preview');

            const title = titleInput ? titleInput.value : '';
            const icon = iconInput ? iconInput.value : 'star';
            const desc = descTextarea ? descTextarea.value : '';
            const imgUrl = imgPreview ? imgPreview.src : null;

            const isLast = index === sections.length - 1;
            const bgClass = isLast ? 'bg-accent' : 'bg-slate-900';

            html += `
                <div class="timeline-step relative flex gap-6">
                    ${!isLast ? '<div class="timeline-line"></div>' : ''}
                    <div class="relative z-10 w-12 h-12 rounded-full ${bgClass} flex items-center justify-center text-white shrink-0 border-4 border-white shadow-md">
                        <span class="material-symbols-outlined text-xl">${icon}</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-900 leading-none mb-1">${title || 'Untitled'}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-2">${desc.substring(0, 80)}${desc.length > 80 ? '...' : ''}</p>
                        ${imgUrl && !imgUrl.endsWith('.com/') && !imgUrl.includes('undefined') ? `
                            <div class="w-full aspect-video rounded-lg overflow-hidden border border-slate-100 mb-2">
                                <img src="${imgUrl}" class="w-full h-full object-cover" />
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', updatePreview);
</script>
@endsection
