<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;

class TicketController extends Controller
{
    public function TicketList(Request $request)
    {
        $id = auth()->user()->id;

        $filter = $request->query("filter");

        $query = Ticket::where('user_id', $id);

        if($filter === "Working"){
            $query->where('statut',"⌛");
        }
        if($filter === "Finish"){
            $query->where('statut',"✅");
        }
        if($filter === "Facturable"){
            $query->where('facturable',"🪙");
        }

        $tickets = $query->get();

        return view('tickets.Ticket-List', [
            "tickets" => $tickets,
            "id" => $id,
        ]);
    }

    public function Ticket($id)
    {

        $ticket = Ticket::find($id);

        return view('tickets.Ticket', [
            "ticket" => $ticket,
        ]);
    }

    public function TicketForm()
    {
        $id = auth()->user()->id;
        $projects = Project::where("user_id", $id)->get();
        return view('tickets.Forms-Ticket', [
            "id" => $id,
            "projects" => $projects,
        ]);
    }

    public function Store(Request $request)
    {
        $id = auth()->user()->id;
        $done = false;
        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'ticket-client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
        ]);
        if(!$validated){
            return redirect()->route('tickets.Ticket-List');
        }

        if ($validated['project'] !== 'No-Project') {
            $project = Project::where('title', $validated['project'])->first();
            $project_id = $project ? $project->id : null;
        } else {
            $project_id = -1;
        }

        $project = Project::find($project_id);
        if ($project) {
            $project->workingTickets = $project->workingTickets + 1;
            $project->ticketNumber = Ticket::where('project_id', $project->id)->count();
            $project->save();
        }


        Ticket::create([
            'user_id' => $id,
            'title' => $validated['ticket-title'],
            'client' => $validated['ticket-client'],
            'description' => $validated['description'] ?? "",
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id ?? -1 ,
            'statut' => "⌛",
        ]);

        $done = true;

        return redirect()->route('tickets.TicketList', ['id' => $id, 'done' => $done]);
    }

    public function update($id,Request $request)
    {
       
        $ticket = Ticket::find($id);
        
        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'ticket-client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
            'project_id' => ['nullable','string'],
        ]);

        $Prev_project = Project::find($ticket->project_id);
        if ($Prev_project) {
            if($ticket->statut == "⌛"){
                $Prev_project->workingTickets = ($project->workingTickets ?? 0) - 1;
            }
            $Prev_project->save();
        }

        $project_id = Project::where('title',$validated['project'])->first();
        $project_id = $project_id->id;

        $ticket->update([
            'title' => $validated['ticket-title'],
            'client' => $validated['ticket-client'],
            'description' => $validated['description'] ?? $ticket->description, 
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id ?? -1,
            'statut' => $ticket->statut,
        ]);

        /* dd($Prev_project); */

        $Prev_project->ticketNumber = Ticket::where('project_id', $Prev_project->id)->count();

        $project = Project::find($project_id);
        if ($project) {
            if($ticket->statut == "⌛"){
                $project->workingTickets = ($project->workingTickets ?? 0) + 1;
            }
            $project->ticketNumber = Ticket::where('project_id', $project->id)->count();
            $project->save();
        }

        return redirect()->route('tickets.Ticket', $id);
    }

    public function Validate($id){

        $ticket = Ticket::find($id);

        if($ticket->statut == "✅"){
            $ticket->update([
                'statut' => "⌛",
            ]);

            $project = Project::find($ticket->project_id);
            if ($project) {
                $project->workingTickets = $project->workingTickets + 1;
                $project->save();
            }
        }
        else{
            $project = Project::find($ticket->project_id);
            if ($project) {
                $project->workingTickets = $project->workingTickets - 1;
                $project->save();
            }
            $ticket->update([
                'statut' => "✅",
            ]);
        }
        
        return redirect()->route('tickets.Ticket', $id);
    }

    public function Edit($id)
    {
        $ticket = Ticket::find($id);
        $u_id = $ticket->user_id;
        $projects = Project::where("user_id", $u_id)->get();

        return view('tickets.Update-Ticket', [
            "ticket" => $ticket,
            "projects" => $projects,
        ]);
    }

    public function Delete(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:Ticket,id'],
        ]);

        $ticket = Ticket::findOrFail($validated['id']);

        

        if($ticket->statut == "⌛"){
            $project = Project::find($ticket->project_id);
            if ($project) {
                $project->workingTickets = $project->workingTickets - 1; // ou autre logique
                $project->save();
            }
        }

        $user_id = $ticket->user_id;
        $project_id = $ticket->project_id;

        $ticket->delete();

        $project->ticketNumber = Ticket::where('project_id', $project_id)->count();

        return redirect()->route('tickets.TicketList', $user_id);
    }

    
    
}