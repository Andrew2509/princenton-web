@extends('admin.layouts.app')
@section('title', 'Add New Skill')

@section('content')
{{-- Breadcrumb Header --}}
<div class="flex items-center gap-2 text-sm mb-8">
    <a class="text-slate-500 hover:text-accent transition-colors" href="{{ route('admin.skills.index') }}">Skills</a>
    <span class="material-symbols-outlined text-slate-400 text-sm">chevron_right</span>
    <span class="font-semibold text-slate-900">Add New Skill</span>
</div>

<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Add New Skill</h1>
        <p class="text-slate-500 text-sm mt-1">Populate the details below to add a new technology to your stack.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.skills.store') }}" method="POST" class="divide-y divide-slate-100">
            @csrf

            {{-- Icon Section --}}
            <div class="p-8">
                <label class="block text-sm font-bold text-slate-700 mb-4 uppercase tracking-wider">Technology Icon</label>
                <div class="flex items-start gap-8">
                    <div class="flex-1 space-y-4">
                        {{-- Icon URL Input --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Icon Image URL</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">link</span>
                                <input name="icon_url" id="icon-url-input" value="{{ old('icon_url') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all" placeholder="https://cdn.example.com/icons/react.svg" type="url" oninput="updateIconPreview()"/>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">Paste a direct link to an SVG or PNG icon image</p>
                        </div>
                        {{-- Material Symbol Fallback --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-1">Or use Material Symbol name</label>
                            <input name="icon" id="icon-input" value="{{ old('icon', 'code') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none" placeholder="e.g. code, palette, database" type="text" oninput="updateIconPreview()"/>
                            <p class="text-[10px] text-slate-400 mt-1">Used as fallback when no image URL is provided</p>
                        </div>
                    </div>
                    {{-- Preview --}}
                    <div class="w-32 flex flex-col items-center">
                        <div id="icon-preview-box" class="w-20 h-20 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center mb-2 overflow-hidden">
                            <img id="icon-preview-img" src="" alt="Icon preview" class="w-14 h-14 object-contain hidden"/>
                            <span id="icon-preview-span" class="material-symbols-outlined text-slate-400 text-3xl">{{ old('icon', 'code') }}</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Preview</span>
                    </div>
                </div>
            </div>

            {{-- Fields Section --}}
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700">Skill Name</label>
                    <input name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all" placeholder="e.g. React, Python, Docker" type="text" required/>
                </div>
                <div class="space-y-2 md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700">Category</label>
                    <div class="relative">
                        <select name="category" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none appearance-none transition-all cursor-pointer">
                            <option disabled {{ old('category') ? '' : 'selected' }} value="">Select category</option>
                            <option {{ old('category') === 'Frontend' ? 'selected' : '' }}>Frontend</option>
                            <option {{ old('category') === 'Backend' ? 'selected' : '' }}>Backend</option>
                            <option {{ old('category') === 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                            <option {{ old('category') === 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option {{ old('category') === 'Database' ? 'selected' : '' }}>Database</option>
                            <option {{ old('category') === 'DevOps & Cloud' ? 'selected' : '' }}>DevOps &amp; Cloud</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
                    </div>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700">Description</label>
                    <textarea name="description" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all resize-none" placeholder="A brief description of the skill and your expertise level..." rows="3">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- Active Toggle Section --}}
            <div class="p-8 bg-slate-50/50">
                <div class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined">visibility</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Set as Active</p>
                            <p class="text-xs text-slate-500">Enable this to show the skill in your portfolio marquee immediately.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input name="is_active" value="1" checked class="sr-only peer" type="checkbox"/>
                        <div class="w-12 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="p-8 bg-white flex items-center justify-between gap-4">
                <a href="{{ route('admin.skills.index') }}" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-all border border-transparent">
                    Cancel
                </a>
                <button type="submit" class="bg-accent text-white px-8 py-2.5 rounded-lg font-bold text-sm hover:bg-blue-600 transition-all shadow-lg shadow-accent/25 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Save Skill
                </button>
            </div>
        </form>
    </div>

    {{-- Info Tips --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-slate-400 text-xl">info</span>
            <div>
                <p class="text-xs font-bold text-slate-600 uppercase mb-1">Vector Preferred</p>
                <p class="text-[11px] text-slate-500 leading-relaxed">SVG icons provide the best quality across all screen resolutions and devices.</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-slate-400 text-xl">category</span>
            <div>
                <p class="text-xs font-bold text-slate-600 uppercase mb-1">Categorization</p>
                <p class="text-[11px] text-slate-500 leading-relaxed">Correct categories help filter your skills in the portfolio's advanced view.</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-slate-400 text-xl">published_with_changes</span>
            <div>
                <p class="text-xs font-bold text-slate-600 uppercase mb-1">Instant Update</p>
                <p class="text-[11px] text-slate-500 leading-relaxed">Changes saved here will reflect instantly on your live portfolio site.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function updateIconPreview() {
        const urlInput = document.getElementById('icon-url-input');
        const iconInput = document.getElementById('icon-input');
        const previewImg = document.getElementById('icon-preview-img');
        const previewSpan = document.getElementById('icon-preview-span');

        if (urlInput.value.trim()) {
            previewImg.src = urlInput.value.trim();
            previewImg.classList.remove('hidden');
            previewSpan.classList.add('hidden');

            previewImg.onerror = function() {
                previewImg.classList.add('hidden');
                previewSpan.classList.remove('hidden');
                previewSpan.textContent = iconInput.value || 'code';
            };
        } else {
            previewImg.classList.add('hidden');
            previewSpan.classList.remove('hidden');
            previewSpan.textContent = iconInput.value || 'code';
        }
    }

    // Run on page load if old value exists
    document.addEventListener('DOMContentLoaded', updateIconPreview);
</script>
@endsection
