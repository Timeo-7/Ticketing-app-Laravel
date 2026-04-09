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
}