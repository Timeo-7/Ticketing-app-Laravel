<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function TicketList()
    {
        return view('tickets.Ticket-List');
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