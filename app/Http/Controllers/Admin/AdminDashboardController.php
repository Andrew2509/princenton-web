<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\MethodologyStep;
use App\Models\AboutMe;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalSkills = Skill::count();
        $totalSteps = MethodologyStep::count();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects', 'totalSkills', 'totalSteps', 'recentProjects'
        ));
    }
}
