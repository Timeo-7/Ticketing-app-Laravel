@extends('layout.main')

@section('content')

<section>

        <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{ route('tickets.TicketList') }}">← Back to Tickets List</a>
            </div>

            <div class="Right-buttons">
                <div class="Edit-button">
                    <button>✏️ Edit Ticket</button>
                </div>
                <div class="Supression-button">
                    <button>Supprimer le ticket</button>
                </div>
            </div>
            
        </div>
        

        <div class="Ticket-cadre">   
            <h3>Client:</h3><p> {{$ticket->client}}</p>
            <h3>Project:</h3><p> {{$ticket->project}}</p>
            <h3>Description:</h3><p> {{$ticket->description}}</p>
            <ul>
                
            </ul>
            <table class="Table-ticket">
                <tr>
                    <th colspan="2">Ticket Statue</th>
                </tr>
                <tr>
                    <td>Statut:</td> 
                    <td>{{$ticket->statut}}</td>
                </tr>
                <tr>
                    <td>Date de création:</td>
                    <td>{{$ticket->created_at}}</td>
                </tr>
                <tr>
                    <td>Date de dernière mise à jour: </td>
                    <td>{{$ticket->updated_at}}</td>
                </tr>
                <tr>
                    <td>Facturable:</td>
                    <td>{{$ticket->facturable}}</td>
                </tr>
            </table>

            <table class="Table-ticket">
                    <th>Historique des commentaires</th>
                <tr>
                    <td>01/02/2026 10:00 - Commentaire 1: Mise à jour en cours.</td>
                </tr>
                <tr>
                    <td>30/01/2026 09:15 - Commentaire 2: Problème identifié.</td>
                </tr>
            </table>
        </div>




    </section>

    <script src="{{ asset('js/Ticket-Page.js') }}"></script>
@endsection