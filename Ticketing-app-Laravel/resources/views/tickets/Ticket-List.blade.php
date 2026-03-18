@extends('layout.main')

@section('content')

<section class="Tickets-List">

        <div>
            <a class="new-ticket-button" href="{{ route('tickets.TicketForm',['id' => $id]) }}">+ New Ticket</a>
        </div>
           

        <div class="cadre">
            
            <p>Tickets</p>
            <div class="filters-title"></div>
                <div class="filters" aria-label="Filtres par genre">
                    <button class="filter-btn-En-Cours" type="button">En cours</button>
                    <button class="filter-btn-Non-Traite" type="button">Non traité</button>
                    <button class="filter-btn-Money" type="button">Facturable</button>
                </div>

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

        @if(isset($done))
            <div class="ValidForms titanic">
                <p>Formulaire envoyé</p>
            </div>
        @endif

    </section>
    
    <script src="../JS/Ticket-Page.js"></script>
    <script src="../JS/Header.js"></script>
@endsection