<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Project;
use App\Models\Skill;
use App\Models\MethodologyStep;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $about = AboutMe::first();
        $featuredProjects = Project::where('is_featured', true)->orderBy('sort_order')->get();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();

        // Extract unique categories for filter buttons
        $categories = $featuredProjects->pluck('category')->flatMap(function ($cat) {
            return explode(' ', trim($cat));
        })->unique()->filter()->values();

        return view('portfolio', compact('about', 'featuredProjects', 'skills', 'categories'));
    }

    public function projects()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('projects', compact('projects'));
    }

    public function process()
    {
        $steps = MethodologyStep::orderBy('sort_order')->get();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();
        return view('process', compact('steps', 'skills'));
    }

    public function about()
    {
        $about = AboutMe::first();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();
        return view('about', compact('about', 'skills'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        \App\Models\ContactMessage::create($validated);

        return back()->with('success', __('contact.success_message'));
    }
}
