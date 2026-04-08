@extends('layout.main')

@section('content')


<section>

         <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{ route('tickets.TicketList', $id) }}">← Back to Tickets List</a>
            </div>
            
        </div>

        {{-- <div>
            <form id="submitform_ticket" action="{{ route('tickets.Store', ['id' => $id]) }}" method="POST">
                @csrf
                <label for="ticket-title">Ticket Title:</label>
                <input type="text" id="ticket-title" name="ticket-title">
                <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>
                <br>
                <label for="ticket-client">Client Name:</label>
                <input type="text" id="ticket-client" name="ticket-client">
                <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
                <br>
                <label for="project">Project:</label>
                <select type="text" id="projet" name="project">
                    <option value="No-Project">No Project</option>
                    @foreach ($projects as $project)
                        <option value="{{$project->title}}">{{$project->title}}</option>
                    @endforeach
                    
                </select>
                <label for="facturable"> Facturable : <input type="checkbox" id="accept" name="facturable" value="1"> </label>
                    
                <button type="submit" class="Submit-button">Create Ticket</button>
                
            </form>
            <form id="submitform_ticket" data-ticket-api-form data-api-token="{{ $apiToken }}" action="{{ route('api.tickets.store') }}" method="POST">
            @csrf
            <label for="ticket-title">Ticket Title:</label>
            <input type="text" id="ticket-title" name="ticket-title">

            <label for="ticket-client">Client Name:</label>
            <input type="text" id="ticket-client" name="ticket-client">

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="project">Project:</label>
            <select id="project" name="project">
                <option value="No-Project">No Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->title }}">{{ $project->title }}</option>
                @endforeach
            </select>

            <label>Facturable: <input type="checkbox" id="facturable" name="facturable" value="1"></label>

            <button type="submit" data-ticket-submit-button>Create Ticket</button>
        </form>
        </div> --}}

        <div data-ticket-page>

            <!-- Bouton pour ouvrir -->
            <button data-open-ticket-modal>Créer un ticket</button>

            <!-- MODAL -->
            <dialog data-ticket-modal>

                <button data-close-ticket-modal>✖</button>

                <form id="submitform_ticket" method="POST" action="{{ route('tickets.Store', ['id' => $id]) }}">
                    @csrf

                    <label>Ticket Title:</label>
                    <input type="text" id="ticket-title" name="ticket-title">
                    <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>

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

        </div>

        


    </section>


    <script src="{{ asset('js/tickets-modal.js') }}" defer></script>

@endsection