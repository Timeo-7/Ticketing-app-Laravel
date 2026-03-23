<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $id = $id = auth()->user()->id;
        $tickets = Ticket::where('user_id',$id)->get();
        $projects = Project::where('user_id',$id)->get();

        return view('dashboard.Dashboard', [
            "tickets" => $tickets,
            "projects" => $projects,
            "id" => $id,
        ]);
    }
    
}