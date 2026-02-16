@extends('admin.layouts.app')
@section('title', 'About Me Editor')

@section('content')
<form id="about-form" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf @method('PUT')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">About Me Editor</h1>
            <p class="text-slate-500 text-sm mt-1">Manage your public bio, professional philosophy, and profile details.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.about.edit') }}" class="px-4 py-2 text-slate-600 bg-white border border-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">Discard</a>
            <button type="submit" class="px-4 py-2 bg-accent text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors shadow-sm">Save All Changes</button>
        </div>
    </div>

@if(session('success'))
<div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-700 font-medium flex items-center gap-2">
    <span class="material-symbols-outlined text-lg">check_circle</span>
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 font-medium space-y-1">
    <div class="flex items-center gap-2 mb-1">
        <span class="material-symbols-outlined text-lg">error</span>
        <span>Please correct the following errors:</span>
    </div>
    <ul class="list-disc list-inside ml-7">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Profile Photo --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-6">Profile Photo</h3>
                    <div class="flex flex-col items-center">
                        <div class="relative group mb-6">
                            <img id="profile-preview" alt="Profile" class="w-40 h-40 rounded-2xl object-cover border-4 border-slate-50 shadow-sm" src="{{ $about->profile_image_url ?: 'https://via.placeholder.com/160' }}"/>
                            <div class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                            </div>
                        </div>

                        {{-- Upload Input --}}
                        <div id="photo-upload-input" class="w-full">
                            <input type="file" name="profile_image" id="profile-file-input" class="block w-full text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-accent/10 file:text-accent hover:file:bg-accent/20 cursor-pointer" onchange="previewProfileFile(this)"/>
                        </div>

                        <p class="mt-3 text-[10px] text-slate-400 text-center">Recommended: 1:1 Aspect Ratio (Min 400x400px)</p>
                    </div>
                </section>

                {{-- Social Presence --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4">Social Presence</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">LinkedIn URL</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">link</span>
                                <input name="linkedin_url" value="{{ old('linkedin_url', $about->linkedin_url) }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="https://linkedin.com/in/..."/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">GitHub Profile</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">code</span>
                                <input name="github_url" value="{{ old('github_url', $about->github_url) }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="https://github.com/..."/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Dribbble / Behance</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">brush</span>
                                <input name="dribbble_url" value="{{ old('dribbble_url', $about->dribbble_url) }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="https://dribbble.com/..."/>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- CV & Badge --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4">CV & Badge</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">CV Download URL</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">file_download</span>
                                <input name="cv_url" value="{{ old('cv_url', $about->cv_url) }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="https://drive.google.com/..."/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Secondary Badge</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">badge</span>
                                <input name="secondary_badge" value="{{ old('secondary_badge', $about->secondary_badge) }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. Remote Enthusiast"/>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Right Column --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- My Story --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-slate-800">My Story</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                            <input name="name" value="{{ old('name', $about->name) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" required/>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Professional Title (EN)</label>
                                <input name="title" value="{{ old('title', $about->title) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. UI/UX Designer" data-translate-target="about_title_id"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Professional Title (ID)</label>
                                <input id="about_title_id" name="title_id" value="{{ old('title_id', $about->title_id) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="misal: Desainer UI/UX"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Short Tagline (EN)</label>
                                <input name="tagline" value="{{ old('tagline', $about->tagline) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" data-translate-target="about_tagline_id"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Short Tagline (ID)</label>
                                <input id="about_tagline_id" name="tagline_id" value="{{ old('tagline_id', $about->tagline_id) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Bio / Introduction (EN)</label>
                                <textarea name="bio" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" rows="3" data-translate-target="about_bio_id">{{ old('bio', $about->bio) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Bio / Introduction (ID)</label>
                                <textarea id="about_bio_id" name="bio_id" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" rows="3">{{ old('bio_id', $about->bio_id) }}</textarea>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Location</label>
                            <input name="location" value="{{ old('location', $about->location) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. Berlin, DE"/>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Professional Bio (EN)</label>
                                <textarea name="story_text" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" rows="6" data-translate-target="about_story_id">{{ old('story_text', $about->story_text) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Professional Bio (ID)</label>
                                <textarea id="about_story_id" name="story_text_id" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" rows="6">{{ old('story_text_id', $about->story_text_id) }}</textarea>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Hero Section --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-6">Hero Section & Statistics</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Heading (EN)</label>
                                <input name="hero_heading" value="{{ old('hero_heading', $about->hero_heading) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. Programmer | Web Development" data-translate-target="about_hero_h_id"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Hero Heading (ID)</label>
                                <input id="about_hero_h_id" name="hero_heading_id" value="{{ old('hero_heading_id', $about->hero_heading_id) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="misal: Programmer | Pengembangan Web"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Subheading (EN)</label>
                                <input name="hero_subheading" value="{{ old('hero_subheading', $about->hero_subheading) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. UI/UX Design | Fullstack Development" data-translate-target="about_hero_sub_id"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Hero Subheading (ID)</label>
                                <input id="about_hero_sub_id" name="hero_subheading_id" value="{{ old('hero_subheading_id', $about->hero_subheading_id) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="misal: Desain UI/UX | Pengembangan Fullstack"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Projects Completed</label>
                                <input name="stats_projects" value="{{ old('stats_projects', $about->stats_projects) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. 50+"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Experience</label>
                                <input name="stats_experience" value="{{ old('stats_experience', $about->stats_experience) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. 6thn"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Client Satisfaction</label>
                                <input name="stats_satisfaction" value="{{ old('stats_satisfaction', $about->stats_satisfaction) }}" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. 100%"/>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Professional Philosophy (EN) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-6">Professional Philosophy (EN)</h3>
                    <div id="philosophies-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $philosophies = $about->philosophies ?? []; @endphp
                        @foreach($philosophies as $i => $phil)
                        <div class="philosophy-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-2">
                                <span class="material-symbols-outlined text-accent">{{ $phil['icon'] ?? 'lightbulb' }}</span>
                                <button type="button" onclick="this.closest('.philosophy-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <input type="hidden" name="phil_icon[]" value="{{ $phil['icon'] ?? 'lightbulb' }}"/>
                            <input name="phil_title[]" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-900 focus:ring-0 mb-1" type="text" value="{{ $phil['title'] ?? '' }}" placeholder="Philosophy title" data-translate-target="phil-title-id-{{ $i }}"/>
                            <textarea name="phil_desc[]" class="w-full bg-transparent border-none p-0 text-xs text-slate-600 focus:ring-0 resize-none" rows="2" placeholder="Philosophy description" data-translate-target="phil-desc-id-{{ $i }}">{{ $phil['description'] ?? '' }}</textarea>
                        </div>
                        @endforeach

                        <button type="button" onclick="openPhilosophyModal('en')" class="border-2 border-dashed border-slate-200 rounded-lg p-4 flex flex-col items-center justify-center text-slate-400 hover:border-accent hover:text-accent transition-all group min-h-[120px]">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">add_circle</span>
                            <span class="text-xs font-bold mt-1 uppercase">Add Philosophy (EN)</span>
                        </button>
                    </div>
                </section>

                {{-- Professional Philosophy (ID) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-slate-300">
                    <h3 class="font-bold text-slate-400 mb-6 uppercase tracking-widest text-xs">Filosofi Profesional (ID)</h3>
                    <div id="philosophies-id-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $philosophiesId = $about->philosophies_id ?? []; @endphp
                        @foreach($philosophiesId as $i => $phil)
                        <div class="philosophy-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-2">
                                <span class="material-symbols-outlined text-accent">{{ $phil['icon'] ?? 'lightbulb' }}</span>
                                <button type="button" onclick="this.closest('.philosophy-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <input type="hidden" name="phil_icon_id[]" value="{{ $phil['icon'] ?? 'lightbulb' }}"/>
                            <input id="phil-title-id-{{ $i }}" name="phil_title_id[]" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-900 focus:ring-0 mb-1" type="text" value="{{ $phil['title'] ?? '' }}" placeholder="Judul filosofi"/>
                            <textarea id="phil-desc-id-{{ $i }}" name="phil_desc_id[]" class="w-full bg-transparent border-none p-0 text-xs text-slate-600 focus:ring-0 resize-none" rows="2" placeholder="Deskripsi filosofi">{{ $phil['description'] ?? '' }}</textarea>
                        </div>
                        @endforeach

                        <button type="button" onclick="openPhilosophyModal('id')" class="border-2 border-dashed border-slate-100 rounded-lg p-4 flex flex-col items-center justify-center text-slate-300 hover:border-accent hover:text-accent transition-all group min-h-[120px]">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">add_circle</span>
                            <span class="text-xs font-bold mt-1 uppercase">Tambah Filosofi (ID)</span>
                        </button>
                    </div>
                </section>

                {{-- Tools I Love --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4">Tools I Love</h3>
                    <input type="hidden" name="tools_list" id="tools-hidden" value="{{ implode(', ', $about->tools ?? []) }}"/>
                    <div id="tools-container" class="flex flex-wrap gap-2">
                        @foreach($about->tools ?? [] as $tool)
                        <span class="tool-tag inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-700 text-sm font-medium rounded-full border border-slate-200">
                            {{ $tool }}
                            <button type="button" onclick="removeTool(this)" class="material-symbols-outlined text-sm hover:text-red-500 transition-colors">close</button>
                        </span>
                        @endforeach
                        <button type="button" onclick="openToolModal()" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-accent text-sm font-bold rounded-full border border-blue-100 hover:bg-blue-100 transition-colors">
                            <span class="material-symbols-outlined text-sm">add</span> Add Tool
                        </button>
                    </div>
                </section>

                {{-- Experience Timeline (EN) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-6">Experience Timeline (EN)</h3>
                    <div id="experiences-container" class="space-y-4">
                        @php $experiences = $about->experiences ?? []; @endphp
                        @foreach($experiences as $i => $exp)
                        <div class="experience-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full {{ ($exp['is_current'] ?? false) ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm">work</span>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $exp['period'] ?? '' }}</span>
                                </div>
                                <button type="button" onclick="this.closest('.experience-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                <input name="exp_period[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['period'] ?? '' }}" placeholder="2021 — Present"/>
                                <input name="exp_title[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['title'] ?? '' }}" placeholder="Job Title" data-translate-target="exp-title-id-{{ $i }}"/>
                                <input name="exp_company[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['company'] ?? '' }}" placeholder="Company Name"/>
                            </div>
                            <textarea name="exp_desc[]" class="w-full px-3 py-2 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" rows="2" placeholder="Brief description of your role..." data-translate-target="exp-desc-id-{{ $i }}">{{ $exp['description'] ?? '' }}</textarea>
                            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="exp_current[]" value="{{ $i }}" {{ ($exp['is_current'] ?? false) ? 'checked' : '' }} class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent/20"/>
                                <span class="text-xs font-bold text-emerald-600">Current Position</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addExperience()" class="mt-4 w-full border-2 border-dashed border-slate-200 rounded-lg p-3 flex items-center justify-center gap-2 text-slate-400 hover:border-accent hover:text-accent transition-all text-sm font-bold">
                        <span class="material-symbols-outlined text-lg">add_circle</span> Add Experience (EN)
                    </button>
                </section>

                {{-- Experience Timeline (ID) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-slate-300">
                    <h3 class="font-bold text-slate-400 mb-6 uppercase tracking-widest text-xs">Pengalaman Kerja (ID)</h3>
                    <div id="experiences-id-container" class="space-y-4">
                        @php $experiencesId = $about->experiences_id ?? []; @endphp
                        @foreach($experiencesId as $i => $exp)
                        <div class="experience-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full {{ ($exp['is_current'] ?? false) ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm">work</span>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $exp['period'] ?? '' }}</span>
                                </div>
                                <button type="button" onclick="this.closest('.experience-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                <input name="exp_period_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['period'] ?? '' }}" placeholder="2021 — Sekarang"/>
                                <input id="exp-title-id-{{ $i }}" name="exp_title_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['title'] ?? '' }}" placeholder="Judul Pekerjaan"/>
                                <input name="exp_company_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $exp['company'] ?? '' }}" placeholder="Nama Perusahaan"/>
                            </div>
                            <textarea id="exp-desc-id-{{ $i }}" name="exp_desc_id[]" class="w-full px-3 py-2 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" rows="2" placeholder="Deskripsi singkat peran Anda...">{{ $exp['description'] ?? '' }}</textarea>
                            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="exp_current_id[]" value="{{ $i }}" {{ ($exp['is_current'] ?? false) ? 'checked' : '' }} class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent/20"/>
                                <span class="text-xs font-bold text-emerald-600">Posisi Sekarang</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addExperienceId()" class="mt-4 w-full border-2 border-dashed border-slate-100 rounded-lg p-3 flex items-center justify-center gap-2 text-slate-300 hover:border-accent hover:text-accent transition-all text-sm font-bold">
                        <span class="material-symbols-outlined text-lg">add_circle</span> Tambah Pengalaman (ID)
                    </button>
                </section>

                {{-- Education (EN) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-6">Education (EN)</h3>
                    <div id="educations-container" class="space-y-4">
                        @php $educations = $about->educations ?? []; @endphp
                        @foreach($educations as $edu)
                        <div class="education-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm">{{ $edu['icon'] ?? 'school' }}</span>
                                    </div>
                                </div>
                                <button type="button" onclick="this.closest('.education-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <select name="edu_icon[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent">
                                    <option value="school" {{ ($edu['icon'] ?? '') == 'school' ? 'selected' : '' }}>🎓 School</option>
                                    <option value="verified" {{ ($edu['icon'] ?? '') == 'verified' ? 'selected' : '' }}>✅ Certificate</option>
                                    <option value="workspace_premium" {{ ($edu['icon'] ?? '') == 'workspace_premium' ? 'selected' : '' }}>🏆 Premium</option>
                                    <option value="military_tech" {{ ($edu['icon'] ?? '') == 'military_tech' ? 'selected' : '' }}>🎖️ Achievement</option>
                                </select>
                                <input name="edu_degree[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="{{ $edu['degree'] ?? '' }}" placeholder="B.S. Interaction Design" data-translate-target="edu-degree-id-{{ $loop->index }}"/>
                                <input name="edu_institution[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $edu['institution'] ?? '' }}" placeholder="University Name, Year"/>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addEducation()" class="mt-4 w-full border-2 border-dashed border-slate-200 rounded-lg p-3 flex items-center justify-center gap-2 text-slate-400 hover:border-accent hover:text-accent transition-all text-sm font-bold">
                        <span class="material-symbols-outlined text-lg">add_circle</span> Add Education (EN)
                    </button>
                </section>

                {{-- Education (ID) --}}
                <section class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-slate-300">
                    <h3 class="font-bold text-slate-400 mb-6 uppercase tracking-widest text-xs">Pendidikan (ID)</h3>
                    <div id="educations-id-container" class="space-y-4">
                        @php $educationsId = $about->educations_id ?? []; @endphp
                        @foreach($educationsId as $edu)
                        <div class="education-card p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm">{{ $edu['icon'] ?? 'school' }}</span>
                                    </div>
                                </div>
                                <button type="button" onclick="this.closest('.education-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <select name="edu_icon_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent">
                                    <option value="school" {{ ($edu['icon'] ?? '') == 'school' ? 'selected' : '' }}>🎓 Sekolah</option>
                                    <option value="verified" {{ ($edu['icon'] ?? '') == 'verified' ? 'selected' : '' }}>✅ Sertifikat</option>
                                    <option value="workspace_premium" {{ ($edu['icon'] ?? '') == 'workspace_premium' ? 'selected' : '' }}>🏆 Premium</option>
                                    <option value="military_tech" {{ ($edu['icon'] ?? '') == 'military_tech' ? 'selected' : '' }}>🎖️ Penghargaan</option>
                                </select>
                                <input id="edu-degree-id-{{ $loop->index }}" name="edu_degree_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="{{ $edu['degree'] ?? '' }}" placeholder="misal: S1 Desain Komunikasi Visual"/>
                                <input name="edu_institution_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="{{ $edu['institution'] ?? '' }}" placeholder="Nama Universitas, Tahun"/>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addEducationId()" class="mt-4 w-full border-2 border-dashed border-slate-100 rounded-lg p-3 flex items-center justify-center gap-2 text-slate-300 hover:border-accent hover:text-accent transition-all text-sm font-bold">
                        <span class="material-symbols-outlined text-lg">add_circle</span> Tambah Pendidikan (ID)
                    </button>
                </section>

                {{-- Bottom Save --}}
                <div class="pt-4 flex justify-end gap-4">
                    <button type="submit" class="px-8 py-3 bg-accent text-white rounded-xl font-bold hover:bg-blue-600 transition-all shadow-lg shadow-accent/20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">save</span>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Add Philosophy Modal --}}
<div id="philosophy-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">
        {{-- Modal Header --}}
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Add Professional Philosophy</h2>
                <p class="text-sm text-slate-500">Define a core principle that guides your work process.</p>
            </div>
            <button type="button" onclick="closePhilosophyModal()" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="flex-1 overflow-y-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Left: Form --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Choose an Icon</label>
                        <div class="grid grid-cols-5 gap-2" id="modal-icon-grid">
                            @php
                                $modalIcons = ['lightbulb','bolt','favorite','rocket_launch','verified','diversity_3','auto_awesome','psychology','grid_view','more_horiz'];
                            @endphp
                            @foreach($modalIcons as $idx => $iconName)
                            <button type="button" onclick="selectModalIcon('{{ $iconName }}', this)" class="modal-icon-btn aspect-square rounded-lg border {{ $idx === 0 ? 'border-2 border-accent bg-blue-50 text-accent' : 'border-slate-200 hover:border-accent hover:bg-slate-50 text-slate-400 hover:text-accent' }} transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined">{{ $iconName }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Philosophy Title</label>
                        <input id="modal-phil-title" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. User-Centric First" oninput="updateModalPreview()"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Short Description</label>
                        <textarea id="modal-phil-desc" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" placeholder="Describe the 'why' behind this philosophy..." rows="4" oninput="updateModalPreview()"></textarea>
                    </div>
                </div>

                {{-- Right: Live Preview --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-100 flex flex-col">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Live Preview</label>
                    <div class="flex-1 flex items-center justify-center">
                        <div class="w-full p-6 bg-white rounded-xl border border-slate-200 shadow-sm transition-all">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 text-accent flex items-center justify-center">
                                    <span id="modal-preview-icon" class="material-symbols-outlined text-2xl">lightbulb</span>
                                </div>
                            </div>
                            <h4 id="modal-preview-title" class="text-base font-bold text-slate-900 mb-2">Philosophy Title</h4>
                            <p id="modal-preview-desc" class="text-sm text-slate-500 leading-relaxed">Your description will appear here. Keep it concise and impactful for visitors to quickly understand your approach.</p>
                        </div>
                    </div>
                    <p class="mt-4 text-center text-[10px] text-slate-400 italic">This is how your card will appear on the public profile.</p>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="p-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
            <button type="button" onclick="closePhilosophyModal()" class="px-6 py-2.5 text-slate-600 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-slate-50 transition-colors">Cancel</button>
            <button type="button" onclick="confirmAddPhilosophy()" class="px-6 py-2.5 bg-accent text-white rounded-lg text-sm font-semibold hover:bg-blue-600 transition-all shadow-lg shadow-accent/20">Add Philosophy</button>
        </div>
    </div>
</div>

{{-- Add Tool Modal --}}
<div id="tool-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">
        {{-- Modal Header --}}
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Add New Tool</h2>
                <p class="text-sm text-slate-500">Populate your 'Tools I Love' section with new tech and software.</p>
            </div>
            <button type="button" onclick="closeToolModal()" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="flex-1 overflow-y-auto p-8">
            <div class="space-y-6">
                {{-- Tool Logo --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Tool Logo</label>
                    <div class="flex items-center gap-6">
                        <div id="tool-logo-area" class="w-24 h-24 bg-slate-50 border-2 border-slate-200 rounded-xl flex items-center justify-center text-slate-400 overflow-hidden shrink-0">
                            <span class="material-symbols-outlined text-3xl" id="tool-logo-placeholder">image</span>
                            <img id="tool-logo-preview" class="w-full h-full object-contain hidden" alt="Logo"/>
                        </div>
                        <div class="flex-1 space-y-2">
                            <h4 class="text-sm font-semibold text-slate-800">Logo URL</h4>
                            <input id="tool-logo-input" class="w-full px-4 py-2 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="url" placeholder="https://cdn.example.com/logo.png" oninput="updateToolLogoPreview()"/>
                            <p class="text-xs text-slate-500">Paste a direct link to an SVG, PNG, or icon image.</p>
                        </div>
                    </div>
                </div>

                {{-- Name + Category --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tool Name</label>
                        <input id="tool-name-input" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent" type="text" placeholder="e.g. React" oninput="updateToolPreview()"/>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Category</label>
                        <select id="tool-category-input" class="w-full px-4 py-2.5 bg-slate-50 border-slate-200 rounded-lg text-sm focus:ring-accent/20 focus:border-accent">
                            <option disabled selected value="">Select Category</option>
                            <option value="design">Design</option>
                            <option value="development">Development</option>
                            <option value="productivity">Productivity</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div>
                </div>

                {{-- Featured Toggle --}}
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-accent/10 text-accent rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined">star</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Featured Tool</p>
                            <p class="text-xs text-slate-500">Showcase this tool prominently on your homepage.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input id="tool-featured-toggle" type="checkbox" class="sr-only peer"/>
                        <div class="w-11 h-6 bg-slate-300 rounded-full peer peer-checked:bg-accent peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                    </label>
                </div>

                {{-- Live Preview --}}
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Live Preview</label>
                    <div class="p-6 bg-slate-900 rounded-xl flex items-center justify-center border border-slate-800">
                        <div class="flex flex-col items-center">
                            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-[0.2em] mb-4">How it looks in your portfolio</p>
                            <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-white/5 border border-white/10 rounded-full text-white text-sm font-medium backdrop-blur-sm shadow-xl">
                                <div class="w-5 h-5 bg-slate-700 rounded flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xs">image</span>
                                </div>
                                <span id="tool-preview-name">New Tool</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="p-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
            <button type="button" onclick="closeToolModal()" class="px-6 py-2.5 text-slate-600 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-slate-50 transition-colors">Cancel</button>
            <button type="button" onclick="confirmAddTool()" class="px-6 py-2.5 bg-accent text-white rounded-lg text-sm font-semibold hover:bg-blue-600 transition-all shadow-lg shadow-accent/20">Add Tool</button>
        </div>
    </div>
</div>

<script>
    // ── Philosophy Modal ──
    let currentLang = 'en';
    let dynamicIdCounter = 100; // Start at 100 to avoid conflicts with PHP loop indices

    function openPhilosophyModal(lang = 'en') {
        currentLang = lang;
        selectedModalIcon = 'lightbulb';
        document.getElementById('modal-phil-title').value = '';
        document.getElementById('modal-phil-desc').value = '';
        resetModalIconGrid();
        updateModalPreview();
        document.getElementById('philosophy-modal').classList.remove('hidden');
    }

    function closePhilosophyModal() {
        document.getElementById('philosophy-modal').classList.add('hidden');
    }

    function selectModalIcon(iconName, btn) {
        selectedModalIcon = iconName;
        // Reset all icon buttons
        document.querySelectorAll('.modal-icon-btn').forEach(b => {
            b.className = 'modal-icon-btn aspect-square rounded-lg border border-slate-200 hover:border-accent hover:bg-slate-50 text-slate-400 hover:text-accent transition-all flex items-center justify-center';
        });
        // Highlight selected
        btn.className = 'modal-icon-btn aspect-square rounded-lg border-2 border-accent bg-blue-50 text-accent transition-all flex items-center justify-center';
        updateModalPreview();
    }

    function resetModalIconGrid() {
        const btns = document.querySelectorAll('.modal-icon-btn');
        btns.forEach((b, i) => {
            if (i === 0) {
                b.className = 'modal-icon-btn aspect-square rounded-lg border-2 border-accent bg-blue-50 text-accent transition-all flex items-center justify-center';
            } else {
                b.className = 'modal-icon-btn aspect-square rounded-lg border border-slate-200 hover:border-accent hover:bg-slate-50 text-slate-400 hover:text-accent transition-all flex items-center justify-center';
            }
        });
    }

    function updateModalPreview() {
        document.getElementById('modal-preview-icon').textContent = selectedModalIcon;
        const title = document.getElementById('modal-phil-title').value;
        const desc = document.getElementById('modal-phil-desc').value;
        document.getElementById('modal-preview-title').textContent = title || 'Philosophy Title';
        document.getElementById('modal-preview-desc').textContent = desc || 'Your description will appear here. Keep it concise and impactful for visitors to quickly understand your approach.';
    }

    function confirmAddPhilosophy() {
        const title = document.getElementById('modal-phil-title').value.trim();
        const desc = document.getElementById('modal-phil-desc').value.trim();
        if (!title) { alert('Please enter a philosophy title.'); return; }

        const container = currentLang === 'en' ? document.getElementById('philosophies-container') : document.getElementById('philosophies-id-container');
        const suffix = currentLang === 'en' ? '' : '_id';
        const addBtn = container.querySelector('button:last-child');

        const currentId = dynamicIdCounter++;
        const card = document.createElement('div');
        card.className = 'philosophy-card p-4 bg-slate-50 rounded-lg border border-slate-200';
        card.innerHTML = `
            <div class="flex items-start justify-between mb-2">
                <span class="material-symbols-outlined text-accent">${selectedModalIcon}</span>
                <button type="button" onclick="this.closest('.philosophy-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
            </div>
            <input type="hidden" name="phil_icon${suffix}[]" value="${selectedModalIcon}"/>
            <input ${currentLang === 'en' ? `data-translate-target="phil-title-id-${currentId}"` : `id="phil-title-id-${currentId}"`} name="phil_title${suffix}[]" class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-900 focus:ring-0 mb-1" type="text" value="${title}"/>
            <textarea ${currentLang === 'en' ? `data-translate-target="phil-desc-id-${currentId}"` : `id="phil-desc-id-${currentId}"`} name="phil_desc${suffix}[]" class="w-full bg-transparent border-none p-0 text-xs text-slate-600 focus:ring-0 resize-none" rows="2">${desc}</textarea>
        `;
        container.insertBefore(card, addBtn);
        closePhilosophyModal();
    }

    // Close modal on overlay click
    document.getElementById('philosophy-modal').addEventListener('click', function(e) {
        if (e.target === this) closePhilosophyModal();
    });

    // ── Tool Modal ──
    function openToolModal() {
        document.getElementById('tool-name-input').value = '';
        document.getElementById('tool-logo-input').value = '';
        document.getElementById('tool-category-input').selectedIndex = 0;
        document.getElementById('tool-featured-toggle').checked = false;
        document.getElementById('tool-preview-name').textContent = 'New Tool';
        document.getElementById('tool-logo-preview').classList.add('hidden');
        document.getElementById('tool-logo-placeholder').classList.remove('hidden');
        const previewIcon = document.querySelector('#tool-preview-name').previousElementSibling;
        previewIcon.innerHTML = '<span class="material-symbols-outlined text-xs">image</span>';
        document.getElementById('tool-modal').classList.remove('hidden');
        setTimeout(() => document.getElementById('tool-name-input').focus(), 100);
    }

    function closeToolModal() {
        document.getElementById('tool-modal').classList.add('hidden');
    }

    function updateToolPreview() {
        const name = document.getElementById('tool-name-input').value.trim();
        document.getElementById('tool-preview-name').textContent = name || 'New Tool';
    }

    function updateToolLogoPreview() {
        const url = document.getElementById('tool-logo-input').value.trim();
        const preview = document.getElementById('tool-logo-preview');
        const placeholder = document.getElementById('tool-logo-placeholder');
        const previewIcon = document.querySelector('#tool-preview-name').previousElementSibling;

        if (url) {
            preview.src = url;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            previewIcon.innerHTML = `<img src="${url}" class="w-5 h-5 object-contain rounded"/>`;
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            previewIcon.innerHTML = '<span class="material-symbols-outlined text-xs">image</span>';
        }
    }

    function confirmAddTool() {
        const name = document.getElementById('tool-name-input').value.trim();
        if (!name) { alert('Please enter a tool name.'); return; }

        const container = document.getElementById('tools-container');
        const addBtn = container.querySelector('button:last-child');

        const tag = document.createElement('span');
        tag.className = 'tool-tag inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-700 text-sm font-medium rounded-full border border-slate-200';
        tag.innerHTML = `
            ${name}
            <button type="button" onclick="removeTool(this)" class="material-symbols-outlined text-sm hover:text-red-500 transition-colors">close</button>
        `;
        container.insertBefore(tag, addBtn);
        syncToolsHidden();
        closeToolModal();
    }

    // Close tool modal on overlay click
    document.getElementById('tool-modal').addEventListener('click', function(e) {
        if (e.target === this) closeToolModal();
    });

    // ── Tools management ──
    function syncToolsHidden() {
        const tags = document.querySelectorAll('.tool-tag');
        const tools = [];
        tags.forEach(tag => {
            const text = tag.childNodes[0].textContent.trim();
            if (text) tools.push(text);
        });
        document.getElementById('tools-hidden').value = tools.join(', ');
    }

    function removeTool(btn) {
        btn.closest('.tool-tag').remove();
        syncToolsHidden();
    }

    // ── Experience management ──
    function addExperience() {
        const container = document.getElementById('experiences-container');
        const cards = container.querySelectorAll('.experience-card');
        const index = cards.length;

        const currentId = dynamicIdCounter++;
        const card = document.createElement('div');
        card.className = 'experience-card p-4 bg-slate-50 rounded-lg border border-slate-200';
        card.innerHTML = `
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm">work</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">New Position</span>
                </div>
                <button type="button" onclick="this.closest('.experience-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                <input name="exp_period[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="2021 — Present"/>
                <input data-translate-target="exp-title-id-${currentId}" name="exp_title[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Job Title"/>
                <input name="exp_company[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Company Name"/>
            </div>
            <textarea data-translate-target="exp-desc-id-${currentId}" name="exp_desc[]" class="w-full px-3 py-2 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" rows="2" placeholder="Brief description..."></textarea>
            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                <input type="checkbox" name="exp_current[]" value="${index}" class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent/20"/>
                <span class="text-xs font-bold text-emerald-600">Current Position</span>
            </label>
        `;
        container.appendChild(card);
    }

    function addExperienceId() {
        const container = document.getElementById('experiences-id-container');
        const cards = container.querySelectorAll('.experience-card');
        const index = cards.length;

        const currentId = dynamicIdCounter - 1; // Match the last EN experience added
        const card = document.createElement('div');
        card.className = 'experience-card p-4 bg-slate-50 rounded-lg border border-slate-200';
        card.innerHTML = `
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm">work</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Posisi Baru</span>
                </div>
                <button type="button" onclick="this.closest('.experience-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                <input name="exp_period_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="2021 — Sekarang"/>
                <input id="exp-title-id-${currentId}" name="exp_title_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Judul Pekerjaan"/>
                <input name="exp_company_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Nama Perusahaan"/>
            </div>
            <textarea id="exp-desc-id-${currentId}" name="exp_desc_id[]" class="w-full px-3 py-2 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" rows="2" placeholder="Deskripsi peran..."></textarea>
            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                <input type="checkbox" name="exp_current_id[]" value="${index}" class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent/20"/>
                <span class="text-xs font-bold text-emerald-600">Posisi Sekarang</span>
            </label>
        `;
        container.appendChild(card);
    }

    // ── Education management ──
    function addEducation() {
        const container = document.getElementById('educations-container');

                const currentId = dynamicIdCounter++;
                const card = document.createElement('div');
                card.className = 'education-card p-4 bg-slate-50 rounded-lg border border-slate-200';
                card.innerHTML = `
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">school</span>
                            </div>
                        </div>
                        <button type="button" onclick="this.closest('.education-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <select name="edu_icon[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent">
                            <option value="school">🎓 School</option>
                            <option value="verified">✅ Certificate</option>
                            <option value="workspace_premium">🏆 Premium</option>
                            <option value="military_tech">🎖️ Achievement</option>
                        </select>
                        <input data-translate-target="edu-degree-id-${currentId}" name="edu_degree[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Degree/Cert Name"/>
                        <input name="edu_institution[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Institution, Year"/>
                    </div>
                `;
        container.appendChild(card);
    }

    function addEducationId() {
        const container = document.getElementById('educations-id-container');

                const currentId = dynamicIdCounter - 1;
                const card = document.createElement('div');
                card.className = 'education-card p-4 bg-slate-50 rounded-lg border border-slate-200';
                card.innerHTML = `
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">school</span>
                            </div>
                        </div>
                        <button type="button" onclick="this.closest('.education-card').remove()" class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <select name="edu_icon_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent">
                            <option value="school">🎓 Sekolah</option>
                            <option value="verified">✅ Sertifikat</option>
                            <option value="workspace_premium">🏆 Premium</option>
                            <option value="military_tech">🎖️ Penghargaan</option>
                        </select>
                        <input id="edu-degree-id-${currentId}" name="edu_degree_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs font-bold focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="misal: S1 Desain"/>
                        <input name="edu_institution_id[]" class="px-3 py-1.5 bg-white border-slate-200 rounded-lg text-xs focus:ring-accent/20 focus:border-accent" type="text" value="" placeholder="Nama Lembaga, Tahun"/>
                    </div>
                `;
        container.appendChild(card);
    }
    // ── Profile Photo management ──
    function previewProfileFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
