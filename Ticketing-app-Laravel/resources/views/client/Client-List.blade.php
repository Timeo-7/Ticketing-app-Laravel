@extends('layout.main')

@section('content')


<section class="Tickets-List" data-ticket-page>

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