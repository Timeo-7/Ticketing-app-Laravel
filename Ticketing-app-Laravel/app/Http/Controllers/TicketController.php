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

    public function Ticket()
    {
        return view('tickets.Ticket');
    }

    public function TicketForm()
    {
        return view('tickets.Forms-Ticket');
    }

    
    
}