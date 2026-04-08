@extends('layout.main')

@section('content')


<section class="Tickets-List" data-ticket-page>

    <!-- Bouton ouverture modal -->
    <div>
        <button class="new-ticket-button" data-open-ticket-modal>
            + New Ticket
        </button>
    </div>

    <!-- Tableau -->
    <div class="cadre">
        
        <p>Clients</p>

        <table class="Table-ticket">
            <thead>
                <tr>
                    <td>Client</td>
                    <td>id</td>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name}}</td>
                    <td>{{ $client->id}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>



@endsection