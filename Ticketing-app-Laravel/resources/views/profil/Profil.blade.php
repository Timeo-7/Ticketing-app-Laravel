@extends('layout.main')

@section('content')

<section class="Profile">
        <div class="Profil-Picture">
            <img id="Profil-image" src="{{ asset('asset/img/Profile.png') }}" alt="Logo de moi hyper bg" >
            <div><h2 id="Profil Name">Maxence Gautier-Grall</h2></div>
            <div id="Profil-Informations">
                <p>Email : XXXXXXX@XXXXXXX</p>
                <p>Number : +33 (0)7 95 86 42 48</p>
                <p>Account type : Client</p>
            </div>
        </div>
        <div id="Profile-Access">

        
            <div class="Dashboard-Stats">
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
        </div>
    </section>

@endsection