<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MethodologyStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMethodologyController extends Controller
{
    public function index()
    {
        $steps = MethodologyStep::orderBy('phase_number')->get();

        // If no steps exist yet, create the default STAR stages
        if ($steps->isEmpty()) {
            $defaults = [
                ['phase_number' => 1, 'title' => 'Situation', 'icon' => 'explore', 'description' => 'Setting the context by describing the background of the project, including the specific challenge or problem that needed to be addressed.'],
                ['phase_number' => 2, 'title' => 'Task', 'icon' => 'assignment', 'description' => 'Defining the specific objectives and the role I played in the project, outlining the exact requirements and goals for the solution.'],
                ['phase_number' => 3, 'title' => 'Action', 'icon' => 'construction', 'description' => 'Detailed walkthrough of the steps taken, methodologies used, and the development process implemented to achieve the desired outcome.'],
                ['phase_number' => 4, 'title' => 'Result', 'icon' => 'verified', 'description' => 'The final outcome of the project, including performance metrics, user feedback, and the overall impact of the solution provided.'],
            ];
            foreach ($defaults as $d) {
                MethodologyStep::create($d);
            }
            $steps = MethodologyStep::orderBy('phase_number')->get();
        }

        return view('admin.methodology.index', compact('steps'));
    }

    public function create()
    {
        $nextPhase = MethodologyStep::max('phase_number') + 1;
        return view('admin.methodology.create', compact('nextPhase'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phase_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'description_id' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'image_url' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('methodology', 'public');
            $validated['image_url'] = Storage::url($path);
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
        }

        MethodologyStep::create($validated);

        return redirect()->route('admin.methodology.index')
            ->with('success', 'Methodology step created successfully.');
    }

    public function edit(MethodologyStep $methodology)
    {
        return view('admin.methodology.edit', ['step' => $methodology]);
    }

    /**
     * Bulk update all methodology steps at once (from the single-page editor).
     */
    public function bulkUpdate(Request $request)
    {
        $steps = $request->input('steps', []);

        foreach ($steps as $id => $data) {
            $step = MethodologyStep::find($id);
            if ($step) {
                $updateData = [
                    'title' => $data['title'] ?? $step->title,
                    'title_id' => $data['title_id'] ?? $step->title_id,
                    'icon' => $data['icon'] ?? $step->icon,
                    'description' => $data['description'] ?? $step->description,
                    'description_id' => $data['description_id'] ?? $step->description_id,
                ];

                if ($request->hasFile("steps.$id.image")) {
                    // Delete old image if it exists
                    if ($step->image_url) {
                        $oldPath = str_replace('/storage/', '', $step->image_url);
                        Storage::disk('public')->delete($oldPath);
                    }
                    $path = $request->file("steps.$id.image")->store('methodology', 'public');
                    $updateData['image_url'] = Storage::url($path);
                } elseif (!empty($data['image_url'])) {
                    $updateData['image_url'] = $data['image_url'];
                }

                $step->update($updateData);
            }
        }

        // Handle newly added stages
        $newSteps = $request->input('new_steps', []);
        foreach ($newSteps as $index => $data) {
            if (!empty($data['title'])) {
                $createData = [
                    'phase_number' => $data['phase_number'] ?? (MethodologyStep::max('phase_number') + 1),
                    'title' => $data['title'],
                    'title_id' => $data['title_id'] ?? null,
                    'icon' => $data['icon'] ?? 'star',
                    'description' => $data['description'] ?? '',
                    'description_id' => $data['description_id'] ?? null,
                ];

                if ($request->hasFile("new_steps.$index.image")) {
                    $path = $request->file("new_steps.$index.image")->store('methodology', 'public');
                    $createData['image_url'] = Storage::url($path);
                } elseif (!empty($data['image_url'])) {
                    $createData['image_url'] = $data['image_url'];
                }

                MethodologyStep::create($createData);
            }
        }

        return redirect()->route('admin.methodology.index')
            ->with('success', 'Methodology stages updated successfully.');
    }

    public function update(Request $request, MethodologyStep $methodology)
    {
        $validated = $request->validate([
            'phase_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_id' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'image_url' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        if (isset($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($methodology->image_url) {
                $oldPath = str_replace('/storage/', '', $methodology->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('methodology', 'public');
            $validated['image_url'] = Storage::url($path);
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
        }

        $methodology->update($validated);

        return redirect()->route('admin.methodology.index')
            ->with('success', 'Methodology step updated successfully.');
    }

    public function destroy(MethodologyStep $methodology)
    {
        // Delete image if it exists
        if ($methodology->image_url) {
            $oldPath = str_replace('/storage/', '', $methodology->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $methodology->delete();

        return redirect()->route('admin.methodology.index')
            ->with('success', 'Methodology step deleted successfully.');
    }
}
