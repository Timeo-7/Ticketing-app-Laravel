@extends('layout.main')

@section('content')


<section>

         <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{ route('tickets.TicketList') }}">← Back to Tickets List</a>
            </div>
            
        </div>

        <div>
            <form id="submitform_ticket" action="" method="POST">
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
                <label for="projet">Project:</label>
                <select type="text" id="projet" name="projet">
                    <option value="project1">No Project</option>
                    <option value="project1">Project 1</option>
                    <option value="project2">Project 2</option>
                </select>
                <label for="colaborators">Colaborators:</label>
                <input type="text" id="colaborators" name="colaborators"></input>

                <label for="accept"> Facturable : <input type="checkbox" id="accept" name="accept"> </label>
                    
                <button type="submit" class="Submit-button">Create Ticket</button>
                
            </form>
        </div>

        <div class="ValidForms titanic">
            <p>Formulaire envoyé</p>
        </div>


    </section>

    <script src="{{ asset('js/Ticket-Forms.js') }}"></script>

@endsection