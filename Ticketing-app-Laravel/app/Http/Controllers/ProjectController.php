<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Ticket;

class ProjectController extends Controller
{
    public function ProjectList()
    {
        $id = auth()->user()->id;

        $projects = Project::where('user_id',$id)->get();

        return view('projects.Project-List', [
            "projects" => $projects,
            "id" => $id,
        ]);
    }

    public function Project($id)
    {

        $project = Project::find($id);

        $query = Ticket::where('user_id', $project->user_id);
        $query->where('project_id',$project->id);
        $tickets = $query->get();

        return view('projects.Project', [
            "project" => $project,
            "tickets" => $tickets,
        ]);
    }
    
    public function ProjectForm()
    {
        $id = auth()->user()->id;

        $clients = Client::where("user_id", $id)->get();

        return view('projects.Forms-Project', [
            "clients" => $clients,
            "id" => $id,
            ]);
    }

    public function Store(Request $request)
    {
        $id = auth()->user()->id;

        $done = false;
        $validated = $request->validate([
            'project-title' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'int', 'max:255'],
            'description' => ['nullable', 'string'],
            'project-file' => ['nullable', 'string'],
        ]);
        if(!$validated){
            return redirect()->route('projects.project-List');
        }

        $client = Client::find($validated['client_id']);
        $client_name = $client->name;
       

        Project::create([
            'user_id' => $id,
            'title' => $validated['project-title'],
            'client_id' => $validated['client_id'],
            'client' => $client->name,
            'description' => $validated['description'] ?? "",
            'contract' => "No file",
            'ticketNumber' => 0,
            'workingTickets' => 0,
            'completeTickets' => 0,
        ]);

        $done = true;

        return redirect()->route('projects.ProjectList', ['id' => $id, 'done' => $done]);
    }


    
    public function Update($id, Request $request)
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

        $tickets = Ticket::where('project_id',$project->id)->get();
        foreach($tickets as $ticket){
            $ticket->delete();
        }

        $user_id = $project->user_id;

        $project->delete();

        return redirect()->route('projects.ProjectList', $user_id);
    }

    

    
    
}