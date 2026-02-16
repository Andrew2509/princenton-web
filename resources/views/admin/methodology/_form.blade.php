<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Phase Number <span class="text-red-500">*</span></label>
            <input type="number" name="phase_number" value="{{ old('phase_number', $step->phase_number ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. 1" required>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Title (EN) <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $step->title ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. Situation / Research" data-translate-target="title_id" required>
        </div>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-bold text-slate-400 mb-2">Title (ID)</label>
        <input type="text" name="title_id" id="title_id" value="{{ old('title_id', $step->title_id ?? '') }}" class="w-full px-4 py-2.5 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="misal: Situasi / Riset">
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Description (EN)</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="Describe this methodology phase..." data-translate-target="description_id">{{ old('description', $step->description ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-400 mb-2">Description (ID)</label>
            <textarea name="description_id" id="description_id" rows="4" class="w-full px-4 py-2.5 border border-slate-100 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="Jelaskan fase metodologi ini...">{{ old('description_id', $step->description_id ?? '') }}</textarea>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Icon (Material Icon name)</label>
            <input type="text" name="icon" value="{{ old('icon', $step->icon ?? 'search') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. search">
            <p class="text-xs text-slate-400 mt-1">Use Material Symbols name</p>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Stage Image</label>
            <div class="space-y-4">
                {{-- Toggle: Upload vs URL --}}
                <div class="flex gap-2 mb-2">
                    <button type="button" onclick="toggleImageMode(this, 'upload')" class="image-mode-btn text-xs font-semibold px-3 py-1 rounded-full border border-accent bg-accent/10 text-accent">Upload File</button>
                    <button type="button" onclick="toggleImageMode(this, 'url')" class="image-mode-btn text-xs font-semibold px-3 py-1 rounded-full border border-slate-200 text-slate-500 hover:border-slate-300">Image URL</button>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-24 h-24 rounded-lg bg-slate-50 border border-slate-200 overflow-hidden shrink-0 relative group">
                        <img id="image-preview" src="{{ $step->image_url ?? '' }}" class="w-full h-full object-cover {{ isset($step->image_url) ? '' : 'hidden' }}"/>
                        <div id="image-placeholder" class="absolute inset-0 flex items-center justify-center {{ isset($step->image_url) ? 'hidden' : '' }}">
                            <span class="material-symbols-outlined text-slate-300 text-3xl">image</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        {{-- File upload mode --}}
                        <div id="image-upload-mode">
                            <input type="file" name="image" id="category-image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent/10 file:text-accent hover:file:bg-accent/20 cursor-pointer" onchange="previewImage(this)"/>
                            <p class="text-xs text-slate-400 mt-2">Recommended: 800x450px (JPG, PNG, WEBP)</p>
                        </div>
                        {{-- URL mode --}}
                        <div id="image-url-mode" class="hidden">
                            <input type="text" name="image_url" id="image-url-input" value="{{ old('image_url', $step->image_url ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="https://example.com/image.jpg" oninput="previewImageUrl(this.value)"/>
                            <p class="text-xs text-slate-400 mt-2">Paste an external image URL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $step->sort_order ?? 0) }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
        </div>
    </div>
    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Tags</label>
        <input type="text" name="tags" value="{{ old('tags', isset($step) && $step->tags ? implode(', ', $step->tags) : '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. User Interviews, Audits">
        <p class="text-xs text-slate-400 mt-1">Comma-separated values</p>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImageUrl(url) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        if (url && url.trim() !== '') {
            preview.src = url;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }

    function toggleImageMode(btn, mode) {
        // Update button styles
        document.querySelectorAll('.image-mode-btn').forEach(b => {
            b.classList.remove('border-accent', 'bg-accent/10', 'text-accent');
            b.classList.add('border-slate-200', 'text-slate-500');
        });
        btn.classList.remove('border-slate-200', 'text-slate-500');
        btn.classList.add('border-accent', 'bg-accent/10', 'text-accent');

        // Toggle modes
        const uploadMode = document.getElementById('image-upload-mode');
        const urlMode = document.getElementById('image-url-mode');
        if (mode === 'url') {
            uploadMode.classList.add('hidden');
            urlMode.classList.remove('hidden');
        } else {
            uploadMode.classList.remove('hidden');
            urlMode.classList.add('hidden');
        }
    }
</script>
