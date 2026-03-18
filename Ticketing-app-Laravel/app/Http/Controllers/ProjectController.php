<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;

class ProjectController extends Controller
{
    public function ProjectList($id)
    {
        $projects = Project::where('user_id',$id)->get();
        return view('projects.Project-List', [
            "projects" => $projects,
            "id" => $id,
        ]);
    }

    public function Project($id)
    {
        $project = Project::find($id);
        $tickets = Ticket::where('project_id',$id)->get();

        return view('projects.Project', [
            "project" => $project,
            "tickets" => $tickets,
        ]);
    }
    
    public function ProjectForm($id)
    {
        return view('projects.Forms-Project', [
            "id" => $id
            ]);
    }

    public function Store(Request $request, $id)
    {
        $done = false;
        $validated = $request->validate([
            'project-title' => ['required', 'string', 'max:255'],
            'project-client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project-file' => ['nullable', 'string'],
        ]);
        if(!$validated){
            return redirect()->route('projects.project-List');
        }

       

        Project::create([
            'user_id' => $id,
            'title' => $validated['project-title'],
            'client' => $validated['project-client'],
            'description' => $validated['description'] ?? "",
            'contract' => "No file",
            'ticketNumber' => 0,
            'workingTickets' => 0,
            'waitingTickets' => 0,
        ]);

        $done = true;

        return redirect()->route('projects.ProjectList', ['id' => $id, 'done' => $done]);
    }


    
    public function Update(Request $request, $id)
    {

        $project = Project::find($id);
        
        $validated = $request->validate([
            
            'project-title' => ['required', 'string', 'max:255'],
            'project-client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project-file' => ['nullable', 'string'],
        ]);


        $project->update([
            'title' => $validated['project-title'],
            'client' => $validated['project-client'],
            'description' => $validated['description'] ?? $project->description,
            'contract' =>  $validated['contract'] ?? $project->contract,
        ]);

        return redirect()->route('projects.Project', $id);
    }

    public function Edit($id)
    {
        $project = Project::find($id);
    

        return view('projects.Update-Project', [
            "project" => $project,
        ]);
    }

    public function Delete(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:projects,id'],
        ]);

        $project = Project::findOrFail($validated['id']);

        $user_id = $project->user_id;

        $project->delete();

        return redirect()->route('projects.ProjectList', $user_id);
    }

    

    
    
}