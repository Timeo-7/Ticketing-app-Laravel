@extends('layout.main')

@section('content')



    <section>

         <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{route('tickets.Ticket', $ticket->id)}}">← Back to Tickets List</a>
            </div>
        </div>

        <div>
            <form id="submitform_ticket" action="{{ route('tickets.Update', $ticket->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="ticket-title">Ticket Title:</label>
                <input type="text" id="ticket-title" name="ticket-title" value="{{$ticket->title}}">
                <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>
                <br>
                <label for="ticket-client">Client Name:</label>
                <input type="text" id="ticket-client" name="ticket-client" value="{{$ticket->client}}">
                <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" value="{{$ticket->description}}"></textarea>
                <br>
                <label for="project">Project:</label>
                <select id="idProject" name="project">
                    <option value="No project">No project</option>
                    <option value="project1">Project 1</option>
                    <option value="project2">Project 2</option>
                </select>
                <label for="facturable"> Facturable : <input type="checkbox" id="facturable" name="facturable" value="1" {{ $ticket->facturable === '🪙' ? 'checked' : '' }}> </label>
                    
                <button type="submit" class="Submit-button">Update Ticket</button>
                
            </form>
        </div>

    </section>

    <!-- <script src="../JS/Ticket-Forms.js"></script> -->
    <script src="../JS/Header.js"></script>
</body>

@endsection