@extends('layout.main')

@section('content')

<section class="Profile">
        <div class="Profil-Picture">
            <img id="Profil-image" src="{{ asset('asset/img/Profile.png') }}" alt="Logo" >
            <div><h2 id="Profil Name">{{$User->name}}</h2></div>
            <div id="Profil-Informations">
                <p>Email : {{$User->email}}</p>
            </div>
        </div>
        <div id="Profile-Access">

        
            <div class="Dashboard-Stats">
                <div class="Fast-Access">
                    <h2>Fast-Access</h2>

                    <div>
                        <div class="access-list">
                             <div class="access-list">
                            <div class="cadre">   
                                <a  href="{{ route('projects.ProjectList') }}">Projects</a>
                                    @foreach ($projects as $project)

                                    <a class="projects-fast-access" href="{{ route('projects.Project', ['id' => $project->id]) }}" >
                                        <p>{{$project->title}}</p>
                                        <p>{{$project->ticketNumber}}x🧾</p>
                                    </a>
                                    

                                    @endforeach

                            </div>
                            
                            <div class="cadre">   
                                <a href="{{ route('tickets.TicketList') }}">Tickets</a>

                                    <table class="Table-ticket">
                                        <thead>
                                            <tr>
                                                <td>Ticket</td>
                                                <td>Client</td>
                                                <td>Statut</td>
                                                <td>Paiement</td>
                                                <td>Date</td>
                                            </tr>
                                        </thead>

                                        <tbody data-ticket-list>
                                            @foreach($tickets as $ticket)
                                            <tr onclick="window.location.href='{{ route('tickets.Ticket', $ticket->id) }}'" style="cursor:pointer;">
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
        </div>
    </section>

@endsection