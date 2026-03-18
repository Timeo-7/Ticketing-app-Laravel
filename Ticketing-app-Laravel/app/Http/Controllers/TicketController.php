<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;

class TicketController extends Controller
{
    public function TicketList($id, Request $request)
    {
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

    public function TicketForm($id)
    {
        $projects = Project::where("user_id", $id)->get();
        return view('tickets.Forms-Ticket', [
            "id" => $id,
            "projects" => $projects,
        ]);
    }

    public function Store(Request $request, $id)
    {
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
            $project_id = null;
        }

        Ticket::create([
            'user_id' => $id,
            'title' => $validated['ticket-title'],
            'client' => $validated['ticket-client'],
            'description' => $validated['description'] ?? "",
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id,
            'statut' => "⌛",
        ]);

        $done = true;

        return redirect()->route('tickets.TicketList', ['id' => $id, 'done' => $done]);
    }

    public function update(Request $request, $id)
    {

        $ticket = Ticket::find($id);

        $project_id = Project::where('user_id',$ticket->user_id)->get();
        

        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'ticket-client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
            'project_id' => $project_id,
        ]);


        $ticket->update([
            'title' => $validated['ticket-title'],
            'client' => $validated['ticket-client'],
            'description' => $validated['description'] ?? $ticket->description, 
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id ?? "No project",
            'statut' => $ticket->statut,
        ]);

        return redirect()->route('tickets.Ticket', $id);
    }

    public function Validate($id){
        $ticket = Ticket::find($id);

        $ticket->update([
            'statut' => "✅",
        ]);
        return redirect()->route('tickets.Ticket', $id);
    }

    public function Edit($id)
    {
        $ticket = Ticket::find($id);
    

        return view('tickets.Update-Ticket', [
            "ticket" => $ticket,
        ]);
    }

    public function Delete(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:Ticket,id'],
        ]);

        $ticket = Ticket::findOrFail($validated['id']);

        $user_id = $ticket->user_id;

        $ticket->delete();

        return redirect()->route('tickets.TicketList', $user_id);
    }

    
    
}