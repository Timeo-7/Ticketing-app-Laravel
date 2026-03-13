<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function ProjectList()
    {
        return view('projects.Project-List', [
            "projects" => Project::all(),
        ]);
    }

    public function Project()
    {
        return view('projects.Project');
    }
    
    public function ProjectForm()
    {
        return view('projects.Forms-Project');
    }
    
}