@extends('layout.main')

@section('content')


<section class="Tickets-List" data-ticket-page>

    <!-- Bouton ouverture modal -->
    <div>
        <button class="new-ticket-button" data-open-ticket-modal>
            + New Client
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

<!-- ================= MODAL ================= -->
<dialog data-ticket-modal class="modal">

    <div class="modal-content">

        <button type="button" data-close-ticket-modal>✖</button>

        <h3>Créer un client</h3>

        <form method="POST" action="{{ route('clients.store') }}">
            @csrf

            <label for="client_name">Nom du client :</label>
            <input 
                type="text" 
                id="client_name" 
                name="name" 
                required
            >

            <button type="submit">Créer</button>

        </form>

    </div>

</dialog>

</section>


{{-- <script src="{{ asset('js/ticket-Forms.js') }}"></script> --}}
<script src="{{ asset('js/clients-modal.js') }}"></script>
{{-- <script src="{{ asset('js/tickets-modalEdit.js') }}"></script> --}}


@endsection