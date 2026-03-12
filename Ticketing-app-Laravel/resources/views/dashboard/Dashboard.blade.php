@extends('layout.main')

@section('content')

<div class="Dashboard-Stats">
        
        <div>
            <div class="stats-list">

                <div class="stats-list-clients">
                    <a class="cadre" href="{{ route('clients.ClientList') }}">Clients: 36</a>
                    <a class="cadre" href="{{ route('projects.ProjectList') }}">Projects: 45</a>
                    <a class="cadre" href="{{ route('tickets.TicketList') }}">Tickets: 125</a>
                </div>

                <div class="stats-list-tickets">
                    <div class="stats-list-tickets1">
                        <div class="cadre">🧾Tickets ouverts: 36</div>
                        <div class="cadre">⏳Tickets en cours: 45</div>
                    </div>
                    <div class="stats-list-tickets2">
                        <div class="cadre">✅Tickets terminés: 125</div>
                        <div class="cadre">💰Tickets facturables en attente: 125</div>
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
                    <a href="{{ route('projects.ProjectList') }}">Projects</a>

                    <a class="projects-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Project 1</p>
                         <p>25x🧾</p>
                    </a>
                    <a class="projects-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Project 2</p>
                         <p>36x🧾</p>
                    </a>

                </div>
                
                <div class="cadre">   
                    <a href="{{ route('tickets.TicketList') }}">Tickets</a>

                    <a class="tickets-fast-access" href="{{ route('tickets.Ticket') }}" >
                        <p>Tickets 1</p>
                        <p>client 1</p>
                        
                        <ul>
                            <li>2x🚹</li>
                            <li>⏳</li>
                            <li>🪙</li>
                            <li>28/01/2026 12:06</li>
                        </ul>
                    </a>

                    <a class="tickets-fast-access" href="{{ route('tickets.Ticket') }}" >
                        <p>Tickets 2</p>
                        <p>client 2</p>
                        
                        <ul>
                            <li>0x🚹</li>
                            <li>❌</li>
                            <li>27/01/2026 14:29</li>
                        </ul>
                    </a>

                </div>
                
            </div>
        </div>
    </div>


    

@endsection