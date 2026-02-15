<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $draftProjects = Project::where('status', 'draft')->count();
        $publishedProjects = Project::where('status', 'published')->count();
        $projects = Project::orderBy('sort_order')->paginate(10);

        return view('admin.projects.index', compact(
            'projects', 'totalProjects', 'draftProjects', 'publishedProjects'
        ));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|array',
            'category.*' => 'string|in:development,mobile-app,ui-ux,saas',
            'tags' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'role_id' => 'nullable|string|max:255',
            'tools' => 'nullable|string|max:500',
            'situation_text' => 'nullable|string',
            'situation_text_id' => 'nullable|string',
            'task_text' => 'nullable|string',
            'task_text_id' => 'nullable|string',
            'action_text' => 'nullable|string',
            'action_text_id' => 'nullable|string',
            'result_text' => 'nullable|string',
            'result_text_id' => 'nullable|string',
            'problem_text' => 'nullable|string',
            'problem_text_id' => 'nullable|string',
            'solution_text' => 'nullable|string',
            'solution_text_id' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'live_link' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string|max:50',
            'year' => 'nullable|string|max:10',
        ]);

        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        if (isset($validated['category']) && is_array($validated['category'])) {
            $validated['category'] = implode(' ', $validated['category']);
        }

        $validated['is_featured'] = $request->has('is_featured');

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|array',
            'category.*' => 'string|in:development,mobile-app,ui-ux,saas',
            'tags' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'role_id' => 'nullable|string|max:255',
            'tools' => 'nullable|string|max:500',
            'situation_text' => 'nullable|string',
            'situation_text_id' => 'nullable|string',
            'task_text' => 'nullable|string',
            'task_text_id' => 'nullable|string',
            'action_text' => 'nullable|string',
            'action_text_id' => 'nullable|string',
            'result_text' => 'nullable|string',
            'result_text_id' => 'nullable|string',
            'problem_text' => 'nullable|string',
            'problem_text_id' => 'nullable|string',
            'solution_text' => 'nullable|string',
            'solution_text_id' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'live_link' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string|max:50',
            'year' => 'nullable|string|max:10',
        ]);

        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        if (isset($validated['category']) && is_array($validated['category'])) {
            $validated['category'] = implode(' ', $validated['category']);
        }

        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
