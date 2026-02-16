@extends('admin.layouts.app')
@section('title', 'Edit Project')

@section('content')
{{-- Custom styles for this form --}}
<style type="text/tailwindcss">
    .form-section {
        @apply bg-white p-8 rounded-xl border border-slate-200 shadow-sm mb-8;
    }
    .input-label {
        @apply block text-sm font-semibold text-slate-700 mb-2;
    }
    .input-field {
        @apply w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none;
    }
    .category-chip {
        @apply px-4 py-2 rounded-full border border-slate-200 bg-white text-sm font-medium text-slate-600 cursor-pointer transition-all hover:border-accent hover:text-accent flex items-center gap-2;
    }
    .category-chip-active {
        @apply border-accent bg-accent/5 text-accent ring-1 ring-accent/20;
    }
</style>

{{-- Header --}}
<div class="flex items-center gap-4 mb-8">
    <a class="text-slate-400 hover:text-slate-600 flex items-center gap-1 transition-colors" href="{{ route('admin.projects.index') }}">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        <span class="text-sm font-medium">Back to Projects</span>
    </a>
    <div class="h-4 w-px bg-slate-200 mx-2"></div>
    <h1 class="text-lg font-bold text-slate-900">Edit Project</h1>
    <span class="text-sm text-slate-400">— {{ $project->title }}</span>
</div>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto pb-28">
    @csrf @method('PUT')

    {{-- Section 1: Basic Information --}}
    <section class="form-section">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-8 h-8 rounded-lg bg-blue-50 text-accent flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">info</span>
            </span>
            <h2 class="text-lg font-bold text-slate-900">Basic Information</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:col-span-2">
                <div>
                    <label class="input-label" for="project-title">Project Title (EN)</label>
                    <input class="input-field" id="project-title" name="title" value="{{ old('title', $project->title) }}" placeholder="e.g. FinTrack SaaS Dashboard" type="text" data-translate-target="project-title-id" required/>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="project-title-id">Project Title (ID)</label>
                    <input class="input-field border-slate-100" id="project-title-id" name="title_id" value="{{ old('title_id', $project->title_id) }}" placeholder="misal: Dashboard SaaS FinTrack" type="text"/>
                </div>
            </div>
            <div>
                <label class="input-label" for="client-name">Client Name</label>
                <input class="input-field" id="client-name" name="client_name" value="{{ old('client_name', $project->client_name) }}" placeholder="Company Name" type="text"/>
            </div>
            <div>
                <label class="input-label" for="year">Year</label>
                <input class="input-field" id="year" name="year" value="{{ old('year', $project->year) }}" placeholder="2024" type="text"/>
            </div>
            <div class="md:col-span-2">
                <label class="input-label">Project Category <span class="text-xs text-slate-400 font-normal">(pilih satu atau lebih)</span></label>
                <div class="flex flex-wrap items-center gap-3 mt-1">
                    @php
                        $selectedCats = is_array(old('category'))
                            ? old('category')
                            : explode(' ', trim(old('category', $project->category ?? '')));
                    @endphp
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="category[]" type="checkbox" value="development" {{ in_array('development', $selectedCats) ? 'checked' : '' }}/>
                        <div class="category-chip peer-checked:border-accent peer-checked:bg-accent/5 peer-checked:text-accent peer-checked:ring-1 peer-checked:ring-accent/20">
                            <span class="material-symbols-outlined text-[18px]">language</span>
                            Web App
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="category[]" type="checkbox" value="mobile-app" {{ in_array('mobile-app', $selectedCats) ? 'checked' : '' }}/>
                        <div class="category-chip peer-checked:border-accent peer-checked:bg-accent/5 peer-checked:text-accent peer-checked:ring-1 peer-checked:ring-accent/20">
                            <span class="material-symbols-outlined text-[18px]">smartphone</span>
                            Mobile App
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="category[]" type="checkbox" value="ui-ux" {{ in_array('ui-ux', $selectedCats) ? 'checked' : '' }}/>
                        <div class="category-chip peer-checked:border-accent peer-checked:bg-accent/5 peer-checked:text-accent peer-checked:ring-1 peer-checked:ring-accent/20">
                            <span class="material-symbols-outlined text-[18px]">draw</span>
                            UI/UX Design
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="category[]" type="checkbox" value="saas" {{ in_array('saas', $selectedCats) ? 'checked' : '' }}/>
                        <div class="category-chip peer-checked:border-accent peer-checked:bg-accent/5 peer-checked:text-accent peer-checked:ring-1 peer-checked:ring-accent/20">
                            <span class="material-symbols-outlined text-[18px]">cloud</span>
                            SaaS
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: STAR Method --}}
    <section class="form-section">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">auto_awesome</span>
            </span>
            <div>
                <h2 class="text-lg font-bold text-slate-900">Project Details</h2>
                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mt-0.5">STAR Method</p>
            </div>
        </div>
        <div class="space-y-8">
            {{-- Situation --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label" for="situation">Situation (EN)</label>
                    <textarea class="input-field min-h-[100px] py-3" id="situation" name="situation_text" placeholder="Describe context..." data-translate-target="situation_id">{{ old('situation_text', $project->situation_text) }}</textarea>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="situation_id">Situation (ID)</label>
                    <textarea class="input-field min-h-[100px] py-3 border-slate-100" id="situation_id" name="situation_text_id" placeholder="Deskripsikan konteks...">{{ old('situation_text_id', $project->situation_text_id) }}</textarea>
                </div>
            </div>
            {{-- Task --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label" for="task">Task (EN)</label>
                    <textarea class="input-field min-h-[100px] py-3" id="task" name="task_text" placeholder="What were the goals?" data-translate-target="task_id">{{ old('task_text', $project->task_text) }}</textarea>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="task_id">Task (ID)</label>
                    <textarea class="input-field min-h-[100px] py-3 border-slate-100" id="task_id" name="task_text_id" placeholder="Apa tujuan dan tantangannya?">{{ old('task_text_id', $project->task_text_id) }}</textarea>
                </div>
            </div>
            {{-- Action --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label" for="action">Action (EN)</label>
                    <textarea class="input-field min-h-[100px] py-3" id="action" name="action_text" placeholder="Steps taken..." data-translate-target="action_id">{{ old('action_text', $project->action_text) }}</textarea>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="action_id">Action (ID)</label>
                    <textarea class="input-field min-h-[100px] py-3 border-slate-100" id="action_id" name="action_text_id" placeholder="Langkah yang diambil...">{{ old('action_text_id', $project->action_text_id) }}</textarea>
                </div>
            </div>
            {{-- Result --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="input-label" for="result">Result (EN)</label>
                    <textarea class="input-field min-h-[100px] py-3" id="result" name="result_text" placeholder="Outcome..." data-translate-target="result_id">{{ old('result_text', $project->result_text) }}</textarea>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="result_id">Result (ID)</label>
                    <textarea class="input-field min-h-[100px] py-3 border-slate-100" id="result_id" name="result_text_id" placeholder="Hasil akhir...">{{ old('result_text_id', $project->result_text_id) }}</textarea>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Media & Assets --}}
    <section class="form-section">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">image</span>
            </span>
            <h2 class="text-lg font-bold text-slate-900">Media & Assets</h2>
        </div>
        <div class="space-y-6">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <label class="input-label mb-0">Project Mockup Image</label>
                </div>

                <div id="mockup-upload-group">
                    <div class="relative group cursor-pointer">
                        <input type="file" name="mockup_file" id="mockup-file-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewMockupFile(this)"/>
                        <div id="mockup-dropzone" class="border-2 border-dashed border-slate-200 rounded-xl p-8 flex flex-col items-center justify-center gap-2 group-hover:border-accent group-hover:bg-blue-50/50 transition-all">
                            <div class="w-12 h-12 rounded-full bg-slate-50 text-slate-400 group-hover:bg-white group-hover:text-accent flex items-center justify-center transition-all">
                                <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold text-slate-700">Click to upload or drag & drop</p>
                                <p class="text-xs text-slate-500">PNG, JPG or WEBP (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="mockup-preview-container" class="mt-4 {{ !$project->image_url ? 'hidden' : '' }} p-2 bg-slate-50 rounded-xl border border-slate-200 inline-block">
                    <div class="relative group">
                        <img id="mockup-preview-img" src="{{ $project->image_url ?? '#' }}" class="max-h-[160px] rounded-lg shadow-sm border border-slate-200" alt="Preview"/>
                        <button type="button" onclick="clearMockupPreview()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center shadow-md hover:bg-red-600 transition-colors">
                            <span class="material-symbols-outlined text-[14px]">close</span>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <label class="input-label" for="live-link">Live Project Link</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">link</span>
                    <input class="input-field pl-10" id="live-link" name="live_link" value="{{ old('live_link', $project->live_link) }}" placeholder="https://project-url.com" type="url"/>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: Tech Stack --}}
    <section class="form-section">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">token</span>
            </span>
            <h2 class="text-lg font-bold text-slate-900">Tech Stack</h2>
        </div>
        <div>
            <label class="input-label">Tools & Technologies</label>
            <div id="tools-container" class="flex flex-wrap gap-2 p-4 bg-slate-50 border border-slate-200 rounded-lg min-h-[60px]">
                <button type="button" onclick="addTool()" class="flex items-center gap-1.5 px-3 py-1 bg-accent/5 border border-accent/20 rounded-full text-xs font-semibold text-accent hover:bg-accent/10 transition-colors">
                    <span class="material-symbols-outlined text-sm">add</span> Add Tool
                </button>
            </div>
            <input type="hidden" name="tools" id="tools-hidden" value="{{ old('tools', $project->tools) }}"/>
            <p class="text-xs text-slate-400 mt-2 italic">Commonly used: Tailwind CSS, React, Laravel, Figma, Flutter, Node.js</p>
        </div>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="input-label" for="role">Your Role (EN)</label>
                    <input class="input-field" id="role" name="role" value="{{ old('role', $project->role) }}" placeholder="e.g. Lead Product Designer" type="text" data-translate-target="role_id"/>
                </div>
                <div>
                    <label class="input-label text-slate-400" for="role_id">Your Role (ID)</label>
                    <input class="input-field border-slate-100" id="role_id" name="role_id" value="{{ old('role_id', $project->role_id) }}" placeholder="misal: Desainer Produk Utama" type="text"/>
                </div>
            </div>
            <div>
                <label class="input-label" for="sort-order">Sort Order</label>
                <input class="input-field" id="sort-order" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" type="number"/>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-3 p-4 bg-slate-50 rounded-lg border border-slate-100">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent"/>
            <label class="text-sm font-medium text-slate-700">Featured Project</label>
        </div>
    </section>

    {{-- Hidden status field --}}
    <input type="hidden" name="status" id="status-field" value="{{ $project->status }}"/>

    {{-- Sticky Bottom Bar --}}
    <div class="fixed bottom-0 left-64 right-0 bg-white border-t border-slate-200 p-6 flex items-center justify-between shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] z-20">
        <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 rounded-lg font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
            Cancel
        </a>
        <div class="flex items-center gap-4">
            <button type="submit" onclick="document.getElementById('status-field').value='draft'" class="px-6 py-2.5 rounded-lg font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition-colors">
                Save as Draft
            </button>
            <button type="submit" onclick="document.getElementById('status-field').value='published'" class="bg-accent text-white px-8 py-2.5 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-600 transition-all shadow-lg shadow-accent/25">
                <span class="material-symbols-outlined text-lg">publish</span>
                Publish Project
            </button>
        </div>
    </div>
</form>

<script>
    // Mockup Management
    function previewMockupFile(input) {
        const container = document.getElementById('mockup-preview-container');
        const img = document.getElementById('mockup-preview-img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                img.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearMockupPreview() {
        document.getElementById('mockup-preview-container').classList.add('hidden');
        document.getElementById('mockup-file-input').value = '';
    }

    // Tech Stack Tool Manager
    const toolsContainer = document.getElementById('tools-container');
    const toolsHidden = document.getElementById('tools-hidden');
    let tools = toolsHidden.value ? toolsHidden.value.split(',').map(t => t.trim()).filter(t => t) : [];

    function renderTools() {
        toolsContainer.querySelectorAll('.tool-chip').forEach(el => el.remove());
        const addBtn = toolsContainer.querySelector('button');

        tools.forEach((tool, index) => {
            const chip = document.createElement('span');
            chip.className = 'tool-chip flex items-center gap-1.5 px-3 py-1 bg-white border border-slate-200 rounded-full text-xs font-semibold text-slate-700 shadow-sm';
            chip.innerHTML = `${tool} <button type="button" onclick="removeTool(${index})" class="material-symbols-outlined text-sm text-slate-400 hover:text-red-500 transition-colors">close</button>`;
            toolsContainer.insertBefore(chip, addBtn);
        });

        toolsHidden.value = tools.join(', ');
    }

    function addTool() {
        const name = prompt('Enter tool/technology name:');
        if (name && name.trim()) {
            tools.push(name.trim());
            renderTools();
        }
    }

    function removeTool(index) {
        tools.splice(index, 1);
        renderTools();
    }

    renderTools();
</script>
@endsection
