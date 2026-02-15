@extends('admin.layouts.app')
@section('title', 'System Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">System Settings</h1>
                <p class="text-slate-500 text-sm mt-1">Configure your portfolio site's global preferences and data.</p>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-accent text-white font-semibold rounded-lg hover:bg-accent/90 transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">save</span>
                Save Changes
            </button>
        </div>

        <div class="mb-8 border-b border-slate-200">
            <nav class="flex gap-8">
                <button type="button" onclick="switchTab('general')" class="tab-btn tab-active py-4 border-b-2 px-1 font-semibold text-sm transition-all" data-tab="general">General</button>
                <button type="button" onclick="switchTab('account')" class="tab-btn py-4 border-b-2 border-transparent px-1 font-medium text-sm text-slate-500 hover:text-slate-700 transition-all" data-tab="account">Account</button>
            </nav>
        </div>

        <div id="general-tab" class="tab-content space-y-8">
            {{-- Site Identity --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Site Identity</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Site Title (EN)</label>
                            <input name="settings[site_title]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="e.g. My Professional Portfolio" type="text" value="{{ $settings['site_title'] ?? 'John Doe Portfolio' }}" data-translate-target="site_title_id"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-400">Site Title (ID)</label>
                            <input id="site_title_id" name="settings[site_title_id]" class="w-full px-4 py-2 bg-slate-50 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="misal: Portofolio John Doe" type="text" value="{{ $settings['site_title_id'] ?? '' }}"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Tagline (EN)</label>
                            <input name="settings[site_tagline]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="e.g. Building digital experiences" type="text" value="{{ $settings['site_tagline'] ?? 'Expert Frontend Designer & Developer' }}" data-translate-target="site_tagline_id"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-400">Tagline (ID)</label>
                            <input id="site_tagline_id" name="settings[site_tagline_id]" class="w-full px-4 py-2 bg-slate-50 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="misal: Membangun pengalaman digital" type="text" value="{{ $settings['site_tagline_id'] ?? '' }}"/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Global Contact Email</label>
                        <input name="settings[contact_email]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="contact@example.com" type="email" value="{{ $settings['contact_email'] ?? 'hello@johndoe.com' }}"/>
                        <p class="text-xs text-slate-400 italic">This email will be used for contact form submissions.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Contact Location (EN)</label>
                            <input name="settings[contact_location]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="e.g. Jakarta, Indonesia (GMT+7)" type="text" value="{{ $settings['contact_location'] ?? 'Jakarta, Indonesia (GMT+7)' }}" data-translate-target="contact_location_id"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-400">Contact Location (ID)</label>
                            <input id="contact_location_id" name="settings[contact_location_id]" class="w-full px-4 py-2 bg-slate-50 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="misal: Jakarta, Indonesia (WIB)" type="text" value="{{ $settings['contact_location_id'] ?? '' }}"/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Google Maps Embed</label>
                        <textarea name="settings[contact_map_embed]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none font-mono" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ $settings['contact_map_embed'] ?? '' }}</textarea>
                        <p class="text-xs text-slate-400 italic">Buka Google Maps → klik Share → Embed a map → salin HTML-nya dan paste di sini.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Default Language</label>
                        <select name="settings[default_language]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none">
                            <option value="en" {{ ($settings['default_language'] ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                            <option value="id" {{ ($settings['default_language'] ?? '') === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                        </select>
                        <p class="text-xs text-slate-400 italic">Bahasa utama yang digunakan saat pertama kali berkunjung.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Map Label (EN)</label>
                            <input name="settings[contact_map_label]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="e.g. Jakarta, ID" type="text" value="{{ $settings['contact_map_label'] ?? 'Jakarta, ID' }}" data-translate-target="contact_map_label_id"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-400">Map Label (ID)</label>
                            <input id="contact_map_label_id" name="settings[contact_map_label_id]" class="w-full px-4 py-2 bg-slate-50 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="misal: Jakarta, ID" type="text" value="{{ $settings['contact_map_label_id'] ?? '' }}"/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Favicon</label>
                        <div class="mt-1 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center p-2 overflow-hidden">
                                @php $faviconUrl = isset($settings['favicon_url']) ? asset($settings['favicon_url']) : null; @endphp
                                <img id="favicon-preview" src="{{ $faviconUrl ?: '#' }}" class="max-w-full max-h-full {{ !$faviconUrl ? 'hidden' : '' }}" />
                                <span id="favicon-placeholder" class="material-symbols-outlined text-slate-400 {{ $faviconUrl ? 'hidden' : '' }}">image</span>
                            </div>
                            <div class="flex-1">
                                <input name="favicon" onchange="previewImage(this, 'favicon-preview', 'favicon-placeholder')" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-accent/10 file:text-accent hover:file:bg-accent/20 transition-all cursor-pointer" type="file" accept="image/x-icon,image/png,image/gif"/>
                                <span class="text-xs text-slate-400 mt-1 block">Upload a favicon (ICO, PNG, or GIF). Max 1MB.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Media Links --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Social Media Links</h3>
                    <button type="button" onclick="addSocialLink()" class="text-xs font-bold text-accent flex items-center gap-1 hover:underline">
                        <span class="material-symbols-outlined text-sm">add</span> Add New
                    </button>
                </div>
                <div id="social-links-container" class="p-6 space-y-4">
                    @php
                        $socialLinks = isset($settings['social_links']) ? json_decode($settings['social_links'], true) : [];
                        if (empty($socialLinks)) {
                            $socialLinks = [['name' => 'LinkedIn', 'url' => ''], ['name' => 'GitHub', 'url' => '']];
                        }
                    @endphp

                    @foreach($socialLinks as $link)
                    <div class="social-link-item flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-slate-600">link</span>
                        </div>
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input name="social_name[]" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="Platform Name" type="text" value="{{ $link['name'] }}"/>
                            <input name="social_url[]" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="URL" type="text" value="{{ $link['url'] }}"/>
                        </div>
                        <button type="button" onclick="this.closest('.social-link-item').remove()" class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Site Status --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Site Status</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="font-semibold text-slate-800">Maintenance Mode</p>
                            <p class="text-sm text-slate-500">When enabled, visitors will see a "Coming Soon" page.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input name="settings[maintenance_mode]" type="checkbox" value="1" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div id="account-tab" class="tab-content hidden space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Profile Information</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="space-y-4 w-full">
                            <label class="block text-sm font-semibold text-slate-700">Profile Picture</label>
                            <div class="flex items-center gap-6">
                                <div class="relative shrink-0">
                                    <img id="avatar-preview" alt="Admin Profile" class="w-24 h-24 rounded-full object-cover ring-4 ring-slate-50 border border-slate-200" src="{{ $user->avatar_url ? asset($user->avatar_url) : 'https://via.placeholder.com/100' }}"/>
                                    <label for="avatar-input" class="absolute bottom-0 right-0 w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center cursor-pointer hover:bg-slate-800 transition-colors border-2 border-white">
                                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                                    </label>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <input id="avatar-input" name="avatar" onchange="previewImage(this, 'avatar-preview')" class="hidden" type="file" accept="image/*"/>
                                    <div class="flex gap-2">
                                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors">
                                            Upload New Photo
                                        </button>
                                    </div>
                                    <p class="text-xs text-slate-400">Recommended: Square image, max 2MB (JPG, PNG).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Full Name</label>
                            <input name="user[name]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="Enter your full name" type="text" value="{{ $user->name }}"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Email Address</label>
                            <input name="user[email]" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="email@example.com" type="email" value="{{ $user->email }}"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Security</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Current Password</label>
                        <input name="current_password" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="••••••••" type="password" autocomplete="current-password"/>
                        <p class="text-xs text-slate-400">Leave blank to keep your current password.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">New Password</label>
                            <input name="new_password" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="••••••••" type="password" autocomplete="new-password"/>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Confirm New Password</label>
                            <input name="new_password_confirmation" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="••••••••" type="password" autocomplete="new-password"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800">Preferences</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="font-semibold text-slate-800">Two-Factor Authentication</p>
                            <p class="text-sm text-slate-500">Secure your account by requiring an additional verification code.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input name="user[two_factor_enabled]" type="checkbox" value="1" {{ $user->two_factor_enabled ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="button" onclick="window.location.reload()" class="px-6 py-2.5 border border-slate-200 text-slate-600 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                Discard Changes
            </button>
            <button type="submit" class="px-6 py-2.5 bg-accent text-white font-semibold rounded-lg hover:bg-accent/90 transition-colors shadow-sm">
                Save Changes
            </button>
        </div>
    </form>
</div>

<style>
    .tab-active {
        @apply border-accent text-accent;
    }
</style>

<script>
    function switchTab(tabId) {
        // Toggle Buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('tab-active', 'font-semibold');
            btn.classList.add('border-transparent', 'font-medium', 'text-slate-500');
            if(btn.dataset.tab === tabId) {
                btn.classList.add('tab-active', 'font-semibold');
                btn.classList.remove('border-transparent', 'font-medium', 'text-slate-500');
            }
        });

        // Toggle Content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(tabId + '-tab').classList.remove('hidden');
    }

    function addSocialLink() {
        const container = document.getElementById('social-links-container');
        const newItem = document.createElement('div');
        newItem.className = 'social-link-item flex items-center gap-4';
        newItem.innerHTML = `
            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-slate-600">link</span>
            </div>
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                <input name="social_name[]" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="Platform Name" type="text" value=""/>
                <input name="social_url[]" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all outline-none" placeholder="URL" type="text" value=""/>
            </div>
            <button type="button" onclick="this.closest('.social-link-item').remove()" class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        container.appendChild(newItem);
    }

    function previewImage(input, previewId, placeholderId = null) {
        const preview = document.getElementById(previewId);
        const placeholder = placeholderId ? document.getElementById(placeholderId) : null;

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                preview.classList.remove('opacity-50');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
