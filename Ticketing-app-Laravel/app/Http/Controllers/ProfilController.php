<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Ticket;

class ProfilController extends Controller
{
    public function Profil()
    {
       $id = auth()->user()->id;

        $projects = Project::where("user_id", $id)->get();
        $tickets = Ticket::where("user_id", $id)->get();

        return view('profil.Profil', [
            "projects" => $projects,
            "tickets" => $tickets,
            "User" => User::where('id', auth()->id())->first(),
        ]);
    }

}