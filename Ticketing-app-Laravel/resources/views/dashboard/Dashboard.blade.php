@extends('layout.main')

@section('content')

<div class="Dashboard-Stats">
        
        <div>
            <div class="stats-list">

                <div class="stats-list-clients">
                    <a class="cadre" href="{{ route('clients.ClientList') }}">Clients: {{$clients->count()}}</a>
                    <a class="cadre" href="{{ route('projects.ProjectList', $id) }}">Projects: {{$projects->count()}}</a>
                    <a class="cadre" href="{{ route('tickets.TicketList', $id) }}">Tickets: {{$tickets->count()}}</a>
                </div>

                <div class="stats-list-tickets">
                    <div class="stats-list-tickets1">
                        <div class="cadre">🧾Tickets: {{$tickets->count()}}</div>
                        <div class="cadre">⏳Tickets en cours: {{$tickets->where("statut","⌛")->count()}}</div>
                    </div>
                    <div class="stats-list-tickets2">
                        <div class="cadre">✅Tickets terminés: {{$tickets->where("statut","✅")->count()}}</div>
                        <div class="cadre">💰Tickets facturables: {{$tickets->where("facturable","🪙")->count()}}</div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

    <div class="Fast-Access">
        <h2>Fast-Access</h2>

        <div>
            <div class="access-list">
                <div class="cadre">   
                    <a href="{{ route('projects.ProjectList', $id) }}">Projects</a>
                     @foreach ($projects as $project)

                        <a class="projects-fast-access" href="{{ route('projects.Project',$project->id) }}" >
                            <p>{{$project->title}}</p>
                            <p>{{$project->workingTickets}}x🧾</p>
                        </a>

                    @endforeach

                </div>
                
                <div class="cadre">   
                    <a href="{{ route('tickets.TicketList',$id) }}">Tickets</a>

                    <table class="Table-ticket" id="content">
                    <thead>
                        <tr>
                            <td>Ticket</td>
                            <td>Client</td>
                            <td>Statut</td>
                            <td>Paiement</td>
                            <td>Date</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tickets as $ticket)
                       <tr onclick="window.location.href='{{ route('tickets.Ticket', ['id' => $ticket->id]) }}'" style="cursor:pointer;">
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->client }}</td>
                            <td>{{ $ticket->statut }}</td>
                            <td>{{ $ticket->facturable }}</td>
                            <td>{{ $ticket->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
                
            </div>
        </div>
    </div>


    

@endsection