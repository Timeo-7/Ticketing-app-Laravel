@extends('layout.main')

@section('content')

<section class="Tickets-List" data-ticket-page data-api-token="{{ auth()->user()->createToken('frontend-token')->plainTextToken }}">

    <!-- Header -->
    <div class="Ticket-Header">   
        <div>
            <a class="back-button" href="{{ route('tickets.TicketList', $ticket->user_id) }}">← Back to Tickets List</a>
        </div>

        <div class="Right-buttons">
            <!-- Bouton ouverture modal update -->
            <button class="Edit-button" data-open-ticket-modal-update>✏️ Edit Ticket</button>

            <!-- Bouton Validate -->
            <button class="Validate-button" data-validate-ticket="{{ $ticket->id }}">
                @if($ticket->statut == "✅")
                    ⌛ Working Ticket
                @else
                    ✅ Validate Ticket
                @endif
            </button>

            <!-- Bouton Delete -->
            <button class="Supression-button" data-delete-ticket="{{ $ticket->id }}">
                Supprimer le ticket
            </button>
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

    <!-- ================= MODAL UPDATE ================= -->
    <dialog data-ticket-modal>

        <button data-close-ticket-modal>✖</button>

        <h3>Modifier le ticket</h3>

        <form 
            id="submitform_ticket" 
            data-ticket-api-form
            data-api-token="{{ auth()->user()->createToken('frontend-token')->plainTextToken }}"
            action="{{ route('tickets.updateApi', $ticket->id) }}" 
            method="POST"
        >
            @csrf
            @method('PUT')
            <label>Ticket Title:</label>
            <input type="text" id="ticket-title" name="ticket-title" value="{{ $ticket->title }}">
            <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>

            <label>Client:</label>
            <input type="text" id="ticket-client" name="ticket-client" value="{{ $ticket->client }}">
            <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>

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

<script src="{{ asset('js/ticket-Page.js') }}"></script>
<script src="{{ asset('js/tickets-modalEdit.js') }}"></script>

@endsection