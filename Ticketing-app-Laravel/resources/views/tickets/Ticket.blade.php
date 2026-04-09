@extends('layout.main')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="Tickets-List" data-ticket-page data-api-token="{{ auth()->user()->createToken('frontend-token')->plainTextToken }}">

    <!-- Header -->
    <div class="Ticket-Header">   
        <div>
            <a class="back-button" href="{{ route('tickets.TicketList', $ticket->user_id) }}">← Back to Tickets List</a>
        </div>

        <div class="Right-buttons">
            <!-- Bouton ouverture modal update -->
            <button class="Edit-button" data-open-ticket-modal-update data-ticket-id="{{$ticket->id}}">✏️ Edit Ticket</button>

            <form class="Validate-button" action="{{ route('tickets.Validate', ['id' => $ticket->id]) }}" method="POST">
                @csrf
                @method('PUT')

                @if($ticket->statut == "✅")
                    <button type="submit">⌛ Working Ticket</button>
                @else
                    <button type="submit">✅ Validate Ticket</button>
                @endif
                
            </form>

            <!-- Bouton Delete -->
            <form class="Supression-button" action="{{ route('tickets.Delete', ['id' => $ticket->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Supprimer le ticket</button>
            </form>
        </div>
    </div>

    <!-- Ticket Details -->
    <div class="Ticket-cadre"> 
        <h3>Title:</h3><p id="ticket-title-display">{{ $ticket->title }}</p>
        <h3>Client:</h3><p id="ticket-client-display">{{ $ticket->client }}</p>
        <h3>Project:</h3><p id="ticket-project-display">{{ $ticket->project }}</p>
        <h3>Description:</h3><p id="ticket-description-display">{{ $ticket->description }}</p>

        <table class="Table-ticket">
            <tr>
                <th colspan="2">Ticket Statut</th>
            </tr>
            <tr>
                <td>Statut:</td> 
                <td id="ticket-statut">{{ $ticket->statut }}</td>
            </tr>
            <tr>
                <td>Date de création:</td>
                <td>{{ $ticket->created_at }}</td>
            </tr>
            <tr>
                <td>Date de dernière mise à jour: </td>
                <td>{{ $ticket->updated_at }}</td>
            </tr>
            <tr>
                <td>Facturable:</td>
                <td id="ticket-facturable-display">{{ $ticket->facturable }}</td>
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

   <!-- Modal Update -->
<dialog data-ticket-modal>
    <button data-close-ticket-modal>✖</button>
    <h3>Modifier le ticket</h3>

    <form id="submitform_ticket">
        @csrf
        @method('PUT')

        <label>Ticket Title:</label>
        <input type="text" id="ticket-title" name="ticket-title" value="{{ $ticket->title }}">
        <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>

        <label>Description:</label>
        <textarea id="description" name="description">{{ $ticket->description }}</textarea>

        <label>Project:</label>
        <select id="project" name="project">
            <option value="No-Project">No Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->title }}" {{ $ticket->project === $project->title ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>

        <label>
            Facturable
            <input type="checkbox" id="facturable" name="facturable" value="1" {{ $ticket->facturable === '🪙' ? 'checked' : '' }}>
        </label>

        <button type="submit" class="Submit-button" data-ticket-submit-button>Mettre à jour</button>
    </form>
</dialog>

</section>

<script src="{{ asset('js/tickets-modalEdit.js') }}"></script>
<script src="{{ asset('js/ticket-Page.js') }}"></script>

@endsection