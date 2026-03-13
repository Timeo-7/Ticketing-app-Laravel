<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function TicketList()
    {
        return view('tickets.Ticket-List', [
            "tickets" => Ticket::all(),
        ]);
    }

    public function Ticket($id)
    {
        $ticket = Ticket::find($id);
        dd($ticket);

        return view('tickets.Ticket', [
            "ticket" => $ticket,
        ]);
    }

    public function TicketForm()
    {
        return view('tickets.Forms-Ticket');
    }

    
    
}