@extends('layout.main')

@section('content')

<section class="Tickets-List">

        <div>
            <a class="new-ticket-button" href="{{ route('tickets.TicketForm') }}">+ New Ticket</a>
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
                        <th>Ticket</th>
                        <th>Client</th>
                        <th>Utilisateurs</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <tr onclick="location.href='{{ route('tickets.Ticket') }}'" style="cursor:pointer;">
                        <td>Ticket 1</td>
                        <td>Client 1</td>
                        <td>2x 🚹</td>
                        <td class="Statut">⏳</td>
                        <td class="Money">🪙</td>
                        <td>28/01/2026 12:06</td>
                    </tr>

                   <tr onclick="location.href='{{ route('tickets.Ticket') }}'" style="cursor:pointer;">
                        <td>Ticket 2</td>
                        <td>Client 2</td>
                        <td>0x 🚹</td>
                        <td class="Statut">❌</td>
                        <td class="Money">—</td>
                        <td>27/01/2026 14:29</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>
    
    <script src="../JS/Ticket-Page.js"></script>
    <script src="../JS/Header.js"></script>
@endsection