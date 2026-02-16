<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function edit()
    {
        $about = AboutMe::first() ?? AboutMe::create([
            'name' => 'John Doe',
            'title' => 'UI/UX Designer & Web Developer',
        ]);

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'title_id' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'tagline_id' => 'nullable|string|max:500',
            'bio' => 'nullable|string',
            'bio_id' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'profile_image_url' => 'nullable|string|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'dribbble_url' => 'nullable|url|max:500',
            'story_text' => 'nullable|string',
            'story_text_id' => 'nullable|string',
            'philosophy_text' => 'nullable|string',
            'philosophy_text_id' => 'nullable|string',
            'hero_heading' => 'nullable|string|max:500',
            'hero_heading_id' => 'nullable|string|max:500',
            'hero_subheading' => 'nullable|string|max:500',
            'hero_subheading_id' => 'nullable|string|max:500',
            'stats_projects' => 'nullable|string|max:50',
            'stats_experience' => 'nullable|string|max:50',
            'stats_satisfaction' => 'nullable|string|max:50',
            'cv_url' => 'nullable|string|max:500',
            'secondary_badge' => 'nullable|string|max:255',
            'secondary_badge_id' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $about = AboutMe::first();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $mimeType = $file->getMimeType();
            $validated['profile_image_url'] = 'data:' . $mimeType . ';base64,' . $imageData;
        }

        // Process philosophies English
        $philosophies = [];
        $philTitles = $request->input('phil_title', []);
        $philDescs = $request->input('phil_desc', []);
        $philIcons = $request->input('phil_icon', []);
        foreach ($philTitles as $i => $title) {
            if (!empty($title)) {
                $philosophies[] = [
                    'title' => $title,
                    'description' => $philDescs[$i] ?? '',
                    'icon' => $philIcons[$i] ?? 'lightbulb',
                ];
            }
        }
        $validated['philosophies'] = $philosophies;

        // Process philosophies Indonesian
        $philosophies_id = [];
        $philTitlesId = $request->input('phil_title_id', []);
        $philDescsId = $request->input('phil_desc_id', []);
        $philIconsId = $request->input('phil_icon_id', []);
        foreach ($philTitlesId as $i => $title) {
            if (!empty($title)) {
                $philosophies_id[] = [
                    'title' => $title,
                    'description' => $philDescsId[$i] ?? '',
                    'icon' => $philIconsId[$i] ?? 'lightbulb',
                ];
            }
        }
        $validated['philosophies_id'] = $philosophies_id;

        // Process tools from comma-separated string
        $toolsStr = $request->input('tools_list', '');
        $validated['tools'] = array_values(array_filter(array_map('trim', explode(',', $toolsStr))));

        // Process experiences English
        $experiences = [];
        $expPeriods = $request->input('exp_period', []);
        $expTitles = $request->input('exp_title', []);
        $expCompanies = $request->input('exp_company', []);
        $expDescs = $request->input('exp_desc', []);
        $expCurrents = $request->input('exp_current', []);
        foreach ($expTitles as $i => $title) {
            if (!empty($title)) {
                $experiences[] = [
                    'period' => $expPeriods[$i] ?? '',
                    'title' => $title,
                    'company' => $expCompanies[$i] ?? '',
                    'description' => $expDescs[$i] ?? '',
                    'is_current' => in_array($i, $expCurrents ?? []),
                ];
            }
        }
        $validated['experiences'] = $experiences;

        // Process experiences Indonesian
        $experiences_id = [];
        $expPeriodsId = $request->input('exp_period_id', []);
        $expTitlesId = $request->input('exp_title_id', []);
        $expCompaniesId = $request->input('exp_company_id', []);
        $expDescsId = $request->input('exp_desc_id', []);
        $expCurrentsId = $request->input('exp_current_id', []);
        foreach ($expTitlesId as $i => $title) {
            if (!empty($title)) {
                $experiences_id[] = [
                    'period' => $expPeriodsId[$i] ?? '',
                    'title' => $title,
                    'company' => $expCompaniesId[$i] ?? '',
                    'description' => $expDescsId[$i] ?? '',
                    'is_current' => in_array($i, $expCurrentsId ?? []),
                ];
            }
        }
        $validated['experiences_id'] = $experiences_id;

        // Process educations English
        $educations = [];
        $eduIcons = $request->input('edu_icon', []);
        $eduDegrees = $request->input('edu_degree', []);
        $eduInsts = $request->input('edu_institution', []);
        foreach ($eduDegrees as $i => $degree) {
            if (!empty($degree)) {
                $educations[] = [
                    'icon' => $eduIcons[$i] ?? 'school',
                    'degree' => $degree,
                    'institution' => $eduInsts[$i] ?? '',
                ];
            }
        }
        $validated['educations'] = $educations;

        // Process educations Indonesian
        $educations_id = [];
        $eduIconsId = $request->input('edu_icon_id', []);
        $eduDegreesId = $request->input('edu_degree_id', []);
        $eduInstsId = $request->input('edu_institution_id', []);
        foreach ($eduDegreesId as $i => $degree) {
            if (!empty($degree)) {
                $educations_id[] = [
                    'icon' => $eduIconsId[$i] ?? 'school',
                    'degree' => $degree,
                    'institution' => $eduInstsId[$i] ?? '',
                ];
            }
        }
        $validated['educations_id'] = $educations_id;

        $about->update($validated);

        return redirect()->route('admin.about.edit')
            ->with('success', 'About Me updated successfully.');
    }
}
