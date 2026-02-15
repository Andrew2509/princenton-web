<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Project Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. FinTrack Pro: Enterprise SaaS" required>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
            <input type="text" name="category" value="{{ old('category', $project->category ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. ui-ux development saas">
            <p class="text-xs text-slate-400 mt-1">Separate multiple categories with spaces</p>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tags</label>
            <input type="text" name="tags" value="{{ old('tags', isset($project) && $project->tags ? implode(', ', $project->tags) : '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. UI/UX Design, Frontend Dev">
            <p class="text-xs text-slate-400 mt-1">Comma-separated tags</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Role</label>
                <input type="text" name="role" value="{{ old('role', $project->role ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. Lead Product Designer">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tools</label>
                <input type="text" name="tools" value="{{ old('tools', $project->tools ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="e.g. Figma, React, Tailwind">
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Image URL</label>
            <input type="text" name="image_url" value="{{ old('image_url', $project->image_url ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="https://example.com/image.jpg">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Year</label>
                <input type="text" name="year" value="{{ old('year', $project->year ?? '') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="2023">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent">
                    <option value="published" {{ old('status', $project->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status', $project->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="completed" {{ old('status', $project->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="in-progress" {{ old('status', $project->status ?? '') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-lg border border-slate-100">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent">
            <label class="text-sm font-medium text-slate-700">Featured Project</label>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Problem Description</label>
        <textarea name="problem_text" rows="4" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="Describe the problem this project solved...">{{ old('problem_text', $project->problem_text ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Solution Description</label>
        <textarea name="solution_text" rows="4" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-accent/20 focus:border-accent" placeholder="Describe the solution...">{{ old('solution_text', $project->solution_text ?? '') }}</textarea>
    </div>
</div>
