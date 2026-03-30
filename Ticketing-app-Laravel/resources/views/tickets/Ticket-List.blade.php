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
        
        <p>Tickets</p>

        <div class="filters">
            <a href="?filter=Working">En cours</a>
            <a href="?filter=Finish">Traité</a>
            <a href="?filter=Facturable">Facturable</a>
        </div>

        <table class="Table-ticket">
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
                <tr onclick="window.location.href='{{ route('tickets.Ticket', $ticket->id) }}'" style="cursor:pointer;">
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

    <!-- Message succès -->
    @if(isset($done))
        <div class="ValidForms titanic">
            <p>Formulaire envoyé</p>
        </div>
    @endif

    <!-- ================= MODAL ================= -->
    <dialog data-ticket-modal>

        <button data-close-ticket-modal>✖</button>

        <h3>Créer un ticket</h3>

        <form id="submitform_ticket" method="POST" action="{{ route('tickets.Store', ['id' => $id]) }}">
            @csrf

            <label>Ticket Title:</label>
            <input type="text" id="ticket-title" name="ticket-title">
            <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>

            <label>Client:</label>
            <input type="text" id="ticket-client" name="ticket-client">
            <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>

            <label>Description:</label>
            <textarea id="description" name="description"></textarea>

            <label>Project:</label>
            <select id="project" name="project">
                <option value="No-Project">No Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->title }}">{{ $project->title }}</option>
                @endforeach
            </select>

            <label>
                Facturable
                <input type="checkbox" id="facturable" name="facturable">
            </label>

            <button type="submit">Créer</button>

        </form>

    </dialog>

</section>


<script src="{{ asset('js/ticket-Forms.js') }}"></script>

@endsection