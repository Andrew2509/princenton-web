@extends('admin.layouts.app')
@section('title', 'Add New Stage')

@section('content')
<style>
    .color-radio:checked + label {
        ring: 2px;
        ring-offset: 2px;
        outline: 2px solid #94a3b8;
        outline-offset: 2px;
    }
</style>

{{-- Breadcrumb Header --}}
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-2 text-sm">
        <a class="text-slate-500 hover:text-accent transition-colors" href="{{ route('admin.methodology.index') }}">Methodology</a>
        <span class="material-symbols-outlined text-slate-400 text-sm">chevron_right</span>
        <span class="font-semibold text-slate-900">Add New Stage</span>
    </div>
</div>

<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 leading-tight">Add New Methodology Stage</h1>
            <p class="text-slate-500 text-sm mt-1">Define a new step in your professional workflow framework.</p>
        </div>
        <div class="px-4 py-2 bg-blue-50 border border-blue-100 rounded-lg">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Stage Position: {{ $nextPhase }}</span>
        </div>
    </div>

    <form action="{{ route('admin.methodology.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="phase_number" value="{{ $nextPhase }}"/>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- Left Column - Form --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 space-y-8">
                        {{-- Stage Title --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Stage Title (EN)</label>
                                <input name="title" id="stage-title" value="{{ old('title') }}" class="w-full h-12 rounded-lg border-slate-200 focus:border-accent focus:ring-accent/20 text-base font-medium placeholder:text-slate-300" placeholder="e.g. Implementation" type="text" data-translate-target="stage-title-id" required oninput="updatePreview()"/>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stage Title (ID)</label>
                                <input name="title_id" id="stage-title-id" value="{{ old('title_id') }}" class="w-full h-12 rounded-lg border-slate-100 focus:border-accent focus:ring-accent/20 text-base font-medium placeholder:text-slate-300" placeholder="misal: Implementasi" type="text" oninput="updatePreview()"/>
                            </div>
                        </div>

                        {{-- Icon Selection --}}
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Icon Selection</label>
                            <div class="p-4 border border-slate-200 rounded-xl space-y-4">
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                                    <input id="icon-search" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" placeholder="Search professional icons..." type="text" oninput="filterIcons(this.value)"/>
                                </div>
                                <input type="hidden" name="icon" id="selected-icon" value="{{ old('icon', 'rocket_launch') }}"/>
                                <div id="icon-grid" class="grid grid-cols-6 sm:grid-cols-8 gap-2">
                                    @php
                                        $icons = [
                                            'rocket_launch', 'settings_suggest', 'analytics', 'monitoring', 'speed',
                                            'terminal', 'hub', 'auto_fix_high', 'explore', 'assignment',
                                            'construction', 'verified', 'science', 'psychology', 'lightbulb',
                                            'architecture', 'code', 'bug_report', 'design_services', 'build',
                                            'preview', 'tune', 'handshake', 'groups', 'campaign',
                                            'trending_up', 'timeline', 'search', 'palette', 'draw',
                                            'database', 'cloud', 'security', 'integration_instructions', 'api',
                                            'deployed_code', 'data_object', 'schema', 'inventory_2', 'rule',
                                        ];
                                        $selectedIcon = old('icon', 'rocket_launch');
                                    @endphp
                                    @foreach($icons as $icon)
                                    <button type="button" data-icon="{{ $icon }}" onclick="selectIcon('{{ $icon }}')"
                                        class="icon-btn w-10 h-10 rounded-lg flex items-center justify-center transition-colors {{ $selectedIcon === $icon ? 'border-2 border-accent bg-accent/5 text-accent' : 'border border-slate-100 hover:border-slate-300 text-slate-500' }}">
                                        <span class="material-symbols-outlined">{{ $icon }}</span>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Description (EN)</label>
                                    <span id="char-count" class="text-[10px] font-bold text-slate-400">0 / 250</span>
                                </div>
                                <textarea name="description" id="stage-desc" class="w-full rounded-lg border-slate-200 focus:border-accent focus:ring-accent/20 text-sm p-4 placeholder:text-slate-300" placeholder="Explain the focus..." rows="5" maxlength="250" data-translate-target="stage-desc-id" oninput="updateCharCount(); updatePreview()">{{ old('description') }}</textarea>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Description (ID)</label>
                                    <span id="char-count-id" class="text-[10px] font-bold text-slate-400">0 / 250</span>
                                </div>
                                <textarea name="description_id" id="stage-desc-id" class="w-full rounded-lg border-slate-100 focus:border-accent focus:ring-accent/20 text-sm p-4 placeholder:text-slate-300" placeholder="Jelaskan fokus..." rows="5" maxlength="250" oninput="updateCharCountId(); updatePreview()">{{ old('description_id') }}</textarea>
                            </div>
                        </div>

                        {{-- Image Upload --}}
                        <div class="space-y-4">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Stage Image</label>
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="w-full md:w-1/2">
                                    <div class="relative group cursor-pointer">
                                        <input type="file" name="image" id="stage-image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)"/>
                                        <div class="w-full aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center group-hover:bg-slate-100 transition-all overflow-hidden relative">
                                            <div id="upload-placeholder" class="text-center">
                                                <span class="material-symbols-outlined text-3xl text-slate-300 mb-2">add_photo_alternate</span>
                                                <p class="text-xs font-bold text-slate-400">Click or drag to upload</p>
                                                <p class="text-[10px] text-slate-300">JPG, PNG or WEBP (Standard Aspect Ratio)</p>
                                            </div>
                                            <img id="image-preview" src="" class="absolute inset-0 w-full h-full object-cover hidden"/>
                                            <div id="image-overlay" class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center hidden">
                                                <span class="material-symbols-outlined text-white">upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col justify-center">
                                    <div class="p-4 bg-amber-50 rounded-lg border border-amber-100">
                                        <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                            <span class="font-bold flex items-center gap-1 mb-1"><span class="material-symbols-outlined text-sm">info</span> Image Recommendation:</span>
                                            Use clear, descriptive visuals representing the phase (e.g. wireframes for "Action", data charts for "Result"). Recommended resolution: 800x450px.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Accent Color --}}
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Accent Color</label>
                            <div class="flex gap-4 items-center">
                                <div class="flex items-center gap-3">
                                    @php
                                        $colors = [
                                            'blue' => 'bg-blue-500',
                                            'purple' => 'bg-purple-500',
                                            'indigo' => 'bg-indigo-500',
                                            'emerald' => 'bg-emerald-500',
                                            'rose' => 'bg-rose-500',
                                        ];
                                        $selectedColor = old('color', 'blue');
                                    @endphp
                                    @foreach($colors as $colorName => $colorClass)
                                    <input class="hidden color-radio" id="color-{{ $colorName }}" name="color" type="radio" value="{{ $colorName }}" {{ $selectedColor === $colorName ? 'checked' : '' }} onchange="updatePreview()"/>
                                    <label class="w-8 h-8 rounded-full {{ $colorClass }} cursor-pointer border-2 border-transparent transition-all hover:scale-110" for="color-{{ $colorName }}"></label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-between items-center">
                        <a href="{{ route('admin.methodology.index') }}" class="px-4 py-2 text-slate-600 font-semibold text-sm hover:text-slate-800 transition-colors">Cancel</a>
                        <button type="submit" class="bg-accent text-white px-8 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-600 transition-all shadow-lg shadow-accent/25 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Add Stage
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column - Live Preview --}}
            <div class="lg:col-span-1 self-start sticky top-0">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                        <h3 class="font-bold text-slate-800">Live Preview</h3>
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase rounded">Card View</span>
                    </div>
                    <div class="p-8">
                        <div class="relative bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="flex flex-col items-center text-center">
                                <div id="preview-icon-circle" class="relative z-10 w-16 h-16 rounded-3xl bg-blue-500 flex items-center justify-center text-white shadow-xl shadow-blue-200 mb-6 transition-colors">
                                    <span id="preview-icon" class="material-symbols-outlined text-3xl">rocket_launch</span>
                                </div>
                                <div class="space-y-3">
                                    <div id="preview-badge" class="inline-block px-3 py-1 bg-white border border-blue-100 rounded-full text-[10px] font-bold text-blue-600 uppercase tracking-tighter shadow-sm">
                                        Stage {{ str_pad($nextPhase, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <h4 id="preview-title" class="font-bold text-xl text-slate-900 leading-none">New Stage Title</h4>
                                    <p id="preview-desc" class="text-sm text-slate-500 leading-relaxed italic">
                                        "Enter a description to see how it will appear on your public profile timeline..."
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 space-y-4">
                            <div class="flex items-center gap-4 p-3 rounded-lg border border-slate-50 bg-slate-50/50">
                                <div class="w-full h-32 bg-slate-200 rounded-lg overflow-hidden relative">
                                    <img id="public-image-preview" src="" class="w-full h-full object-cover hidden"/>
                                    <div id="image-preview-placeholder" class="absolute inset-0 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-300 text-3xl">image</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[10px] text-center text-slate-400 font-medium">This is a representation of the new stage card in the timeline flow.</p>
                        </div>
                    </div>
                </div>

                {{-- Framework Consistency Info --}}
                <div class="mt-6 bg-slate-900 p-5 rounded-xl shadow-lg">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-accent">info</span>
                        <div>
                            <p class="text-sm font-bold text-white">Framework Consistency</p>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed">Adding a new stage will append it to the end of your existing STAR framework (Situation, Task, Action, Result).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const colorMap = {
        blue:    { bg: 'bg-blue-500', shadow: 'shadow-blue-200', border: 'border-blue-100', text: 'text-blue-600' },
        purple:  { bg: 'bg-purple-500', shadow: 'shadow-purple-200', border: 'border-purple-100', text: 'text-purple-600' },
        indigo:  { bg: 'bg-indigo-500', shadow: 'shadow-indigo-200', border: 'border-indigo-100', text: 'text-indigo-600' },
        emerald: { bg: 'bg-emerald-500', shadow: 'shadow-emerald-200', border: 'border-emerald-100', text: 'text-emerald-600' },
        rose:    { bg: 'bg-rose-500', shadow: 'shadow-rose-200', border: 'border-rose-100', text: 'text-rose-600' },
    };

    function selectIcon(iconName) {
        document.getElementById('selected-icon').value = iconName;
        document.querySelectorAll('.icon-btn').forEach(btn => {
            btn.className = btn.className.replace(/border-2 border-accent bg-accent\/5 text-accent/g, 'border border-slate-100 hover:border-slate-300 text-slate-500');
        });
        const selected = document.querySelector(`[data-icon="${iconName}"]`);
        if (selected) {
            selected.className = selected.className.replace(/border border-slate-100 hover:border-slate-300 text-slate-500/g, 'border-2 border-accent bg-accent/5 text-accent');
        }
        updatePreview();
    }

    function filterIcons(query) {
        const q = query.toLowerCase();
        document.querySelectorAll('.icon-btn').forEach(btn => {
            const icon = btn.dataset.icon;
            btn.style.display = icon.includes(q) ? '' : 'none';
        });
    }

    function updateCharCount() {
        const desc = document.getElementById('stage-desc');
        document.getElementById('char-count').textContent = `${desc.value.length} / 250`;
    }

    function updateCharCountId() {
        const desc = document.getElementById('stage-desc-id');
        document.getElementById('char-count-id').textContent = `${desc.value.length} / 250`;
    }

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const overlay = document.getElementById('image-overlay');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                overlay.classList.remove('hidden');
                updatePreview(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updatePreview(imageSrc = null) {
        const title = document.getElementById('stage-title').value || 'New Stage Title';
        const desc = document.getElementById('stage-desc').value;
        const icon = document.getElementById('selected-icon').value;
        const color = document.querySelector('input[name="color"]:checked')?.value || 'blue';
        const c = colorMap[color];

        document.getElementById('preview-title').textContent = title;
        document.getElementById('preview-icon').textContent = icon;
        document.getElementById('preview-desc').textContent = desc
            ? `"${desc}"`
            : '"Enter a description to see how it will appear on your public profile timeline..."';

        // Update icon circle color
        const circle = document.getElementById('preview-icon-circle');
        Object.values(colorMap).forEach(cm => {
            circle.classList.remove(cm.bg, cm.shadow);
        });
        circle.classList.add(c.bg, c.shadow);

        // Update badge color
        const badge = document.getElementById('preview-badge');
        Object.values(colorMap).forEach(cm => {
            badge.classList.remove(cm.border, cm.text);
        });
        badge.classList.add(c.border, c.text);

        // Update public image preview
        const publicPreview = document.getElementById('public-image-preview');
        const publicPlaceholder = document.getElementById('image-preview-placeholder');
        if (imageSrc) {
            publicPreview.src = imageSrc;
            publicPreview.classList.remove('hidden');
            publicPlaceholder.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateCharCount();
        updatePreview();
    });
</script>
@endsection
