<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Skill Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $skill->name ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. React.js" required>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
            <select name="category" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
                <option value="primary" {{ old('category', $skill->category ?? 'primary') === 'primary' ? 'selected' : '' }}>Primary</option>
                <option value="secondary" {{ old('category', $skill->category ?? '') === 'secondary' ? 'selected' : '' }}>Secondary</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Icon URL</label>
            <input type="text" name="icon_url" value="{{ old('icon_url', $skill->icon_url ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="https://...">
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Proficiency (%)</label>
            <input type="number" name="proficiency" value="{{ old('proficiency', $skill->proficiency ?? 80) }}" min="1" max="100" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
        </div>
    </div>
</div>
