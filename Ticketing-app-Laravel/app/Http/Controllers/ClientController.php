<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Project;

class ClientController extends Controller
{

    public function ClientList()
    {
         $id = auth()->user()->id;

        $clients = Client::where("user_id", $id)->get();

        return view('client.Client-List', [
            "clients" => $clients,
            "id" => $id,
        ]);
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Client::create([
            'name' => $request->name,
            'user_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Client créé avec succès');
    }
}