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

        $projects = Project::where("user_id", $id)->get();
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
            "projects" => $projects,
        ]);
    }

    public function Ticket($id)
    {

        $ticket = Ticket::find($id);
        $user_id = auth()->user()->id;
        $projects = Project::where("user_id", $user_id)->get();

        return view('tickets.Ticket', [
            "ticket" => $ticket,
            "projects" => $projects,
        ]);
    }

    public function TicketForm()
    {
        $id = auth()->user()->id;
        $projects = Project::where("user_id", $id)->get();

        // Générer un token API pour ce front
        $apiToken = auth()->user()->createToken('frontend-token')->plainTextToken;

        return view('tickets.Forms-Ticket', [
            "id" => $id,
            "projects" => $projects,
            "apiToken" => $apiToken, // On l’envoie à la vue
        ]);
       /*  return view('tickets.Forms-Ticket', [
            "id" => $id,
            "projects" => $projects,
        ]); */
    }

    public function Store(Request $request)
    {
        $id = auth()->user()->id;
        $user = auth()->user();
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

    /* public function storeApi(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
        ]);

        $project_id = -1;
        if ($validated['project'] !== 'No-Project') {
            $project = Project::where('title', $validated['project'])->first();
            $project_id = $project ? $project->id : -1;

            if ($project) {
                $project->workingTickets++;
                $project->ticketNumber = Ticket::where('project_id', $project->id)->count();
                $project->save();
            }
        }

        if($project){
            $client_name = $project->client;
        }
        else{
             $client_name = "No client";
        }

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => $validated['ticket-title'],
            'client' => $client_name,
            'description' => $validated['description'] ?? "",
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id,
            'statut' => "⌛",
        ]);

        return response()->json([
            'message' => 'Ticket ajouté avec succès.',
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'client' => $ticket->client,
                'description' => $ticket->description,
                'project' => $ticket->project,
                'project_id' => $ticket->project_id,
                'facturable' => $ticket->facturable,
                'statut' => $ticket->statut,
                'user_id' => $ticket->user_id,
                'user_name' => $user->name,
            ],
        ], 201);
    } */

        public function storeApi(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
        ]);

        $project = null;
        $project_id = null;

        if ($validated['project'] !== 'No-Project') {
            $project = Project::where('title', $validated['project'])->first();
            $project_id = $project ? $project->id : null;

            if ($project) {
                $project->workingTickets++;
                $project->ticketNumber = Ticket::where('project_id', $project->id)->count();
                $project->save();
            }
        }

        $client_name = $project ? $project->client : "No client";

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => $validated['ticket-title'],
            'client' => $client_name,
            'description' => $validated['description'] ?? "",
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id,
            'statut' => "⌛",
        ]);
        return response()->json([
            'message' => 'Ticket ajouté avec succès.',
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'client' => $ticket->client,
                'description' => $ticket->description,
                'project' => $ticket->project,
                'project_id' => $ticket->project_id,
                'facturable' => $ticket->facturable,
                'statut' => $ticket->statut,
                'user_id' => $ticket->user_id,
                'user_name' => $user->name,
                'created_at' => $ticket->created_at->format('Y-m-d H:i:s'),
                 'show_url' => route('tickets.Ticket', $ticket->id),
                ],
        ], 201);
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
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $Prev_project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count();
                $Prev_project->completeTickets =  $completeCount;
            }
            $Prev_project->save();
        }

        $project_id = Project::where('title',$validated['project'])->first();
        $project_id = $project_id->id ?? null;

        $ticket->update([
            'title' => $validated['ticket-title'],
            'client' => $validated['ticket-client'],
            'description' => $validated['description'] ?? $ticket->description, 
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $project_id ?? null,
            'statut' => $ticket->statut,
        ]);

        /* dd($Prev_project); */

        if($Prev_project){
            $totalCount = Ticket::where('project_id', $Prev_project->id)->count();
            $Prev_project->ticketNumber = $totalCount;
        }
        

        $project = Project::find($project_id);
        if ($project) {
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count();
                $project->completeTickets =  $completeCount;
            }

            $totalCount = Ticket::where('project_id', $project->id)->count();
            $project->ticketNumber = $totalCount;

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
            $query = Ticket::where('user_id', auth()->user()->id);
            $query2 = $query;
            if ($project) {
                $workingCount = $query->where('statut', "⌛")->count();
                $project->workingTickets = $workingCount + 1;

                $completeCount = $query2->where('statut', "✅")->count();
                $project->completeTickets = $completeCount -1;

                $project->save();
            }
        }
        else{
            $ticket->update([
                'statut' => "✅",
            ]);
            $project = Project::find($ticket->project_id);
            $query = Ticket::where('user_id', auth()->user()->id);
            $query2 = $query;
            if ($project) {
                $workingCount = $query->where('statut', "⌛")->count();
                $project->workingTickets = $workingCount - 1;

                $completeCount = $query2->where('statut', "✅")->count();
                $project->completeTickets = $completeCount + 1;

                $project->save();
            }
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

            $project = Project::find($ticket->project_id);
            if ($project) {
                $query = Ticket::where('user_id', auth()->user()->id);
                if($ticket->statut == "⌛"){
                    $workingCount = $query->where('statut', "⌛")->count();
                    $project->workingTickets = $workingCount;
                }
                else{
                    $completeCount = $query->where('statut', "✅")->count();
                    $project->completeTickets =  $completeCount;
                }
                $project->save();
            }

        $user_id = $ticket->user_id;
        $project_id = $ticket->project_id;
        $Prev_project = Project::find($project_id);

        $ticket->delete();


        
        if($Prev_project){
            $totalCount = Ticket::where('project_id', $project->id)->count();
            $Prev_project->ticketNumber = $totalCount;
            
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $Prev_project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count();
                $Prev_project->completeTickets = $completeCount;
            }
            $Prev_project->save();
        }
       
        return redirect()->route('tickets.TicketList', $user_id);
    }

    public function updateApi($id, Request $request)
    {
        $ticket = Ticket::find($id);
        
        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }

        // Vérifier que l'utilisateur est propriétaire du ticket
        if ($ticket->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $validated = $request->validate([
            'ticket-title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project' => ['nullable', 'string'],
            'facturable' => ['nullable'],
        ]);

        // Gestion du projet précédent
        $Prev_project = Project::find($ticket->project_id);
        if ($Prev_project) {
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $Prev_project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count();
                $Prev_project->completeTickets = $completeCount;
            }
            $Prev_project->save();
        }

        // Récupérer le nouveau projet
        $new_project_id = null;
        if ($validated['project'] !== 'No-Project') {
            $new_project = Project::where('title', $validated['project'])->first();
            $new_project_id = $new_project ? $new_project->id : null;
        }

        $client_name = $new_project ? $new_project->client : "No client";
        // Mettre à jour le ticket
        $ticket->update([
            'title' => $validated['ticket-title'],
            'client' => $client_name,
            'description' => $validated['description'] ?? $ticket->description, 
            'project' => $validated['project'] ?? "No project",
            'facturable' => !empty($validated['facturable']) ? '🪙' : '_',
            'project_id' => $new_project_id,
        ]);

        // Mettre à jour les compteurs du projet précédent
        if ($Prev_project) {
            $totalCount = Ticket::where('project_id', $Prev_project->id)->count();
            $Prev_project->ticketNumber = $totalCount;
            $Prev_project->save();
        }

        // Mettre à jour les compteurs du nouveau projet
        $project = Project::find($new_project_id);
        if ($project) {
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count();
                $project->completeTickets = $completeCount;
            }

            $totalCount = Ticket::where('project_id', $project->id)->count();
            $project->ticketNumber = $totalCount;
            $project->save();
        }

        return response()->json([
            'message' => 'Ticket mis à jour avec succès.',
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'client' => $ticket->client,
                'description' => $ticket->description,
                'project' => $ticket->project,
                'project_id' => $ticket->project_id,
                'facturable' => $ticket->facturable,
                'statut' => $ticket->statut,
                'user_id' => $ticket->user_id,
            ],
        ], 200);
    }

    public function deleteApi($id, Request $request)
    {
        $ticket = Ticket::find($id);
        
        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }

        // Vérifier que l'utilisateur est propriétaire du ticket
        if ($ticket->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $user_id = $ticket->user_id;
        $project = Project::find($ticket->project_id);

        // Mettre à jour les compteurs du projet
        if ($project) {
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count() - 1;
                $project->workingTickets = $workingCount;
            }
            else{
                $completeCount = $query->where('statut', "✅")->count() - 1;
                $project->completeTickets = $completeCount;
            }
            
            $totalCount = Ticket::where('project_id', $project->id)->count() - 1;
            $project->ticketNumber = $totalCount;
            $project->save();
        }

        $ticket->delete();

        return response()->json([
            'message' => 'Ticket supprimé avec succès.',
            'user_id' => $user_id,
        ], 200);
    }

    
    public function validateApi($id, Request $request)
    {
        $ticket = Ticket::find($id);
        
        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }

        if ($ticket->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Même logique que Validate() mais en retour JSON
        if($ticket->statut == "✅"){
            $ticket->update(['statut' => "⌛"]);
        } else {
            $ticket->update(['statut' => "✅"]);
        }

        $project = Project::find($ticket->project_id);
        if ($project) {
            $query = Ticket::where('user_id', auth()->user()->id);
            if($ticket->statut == "⌛"){
                $workingCount = $query->where('statut', "⌛")->count();
                $project->workingTickets = $workingCount;
            } else {
                $completeCount = $query->where('statut', "✅")->count();
                $project->completeTickets = $completeCount;
            }
            $project->save();
        }

        return response()->json([
            'message' => 'Ticket validé',
            'statut' => $ticket->statut,
        ], 200);
    }

    public function editApi($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé'], 404);
        }

        // Vérifier que l'utilisateur est propriétaire du ticket
        if ($ticket->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        // Récupérer la liste des projets de l'utilisateur
        $projects = Project::where('user_id', auth()->user()->id)->get(['id', 'title']);

        return response()->json([
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'client' => $ticket->client,
                'description' => $ticket->description,
                'project' => $ticket->project,
                'project_id' => $ticket->project_id,
                'facturable' => $ticket->facturable,
                'statut' => $ticket->statut,
            ],
            'projects' => $projects
        ], 200);
    }
}