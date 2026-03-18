 @extends('layout.main')

@section('content')

    <section>

        <div class="Ticket-Header">  

            <div>
                <a class="back-button" href="{{ route('projects.ProjectList', $project->user_id) }}">← Back to Projects List</a>
            </div>

            <div class="Right-buttons">
                <a class="Edit-button" href="{{ route('projects.Edit', $project->id) }}">✏️ Edit Ticket</a>

                <form action="{{ route('projects.Delete') }}" method="POST"  class="Supression-button">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <button type="submit">Supprimer le ticket</button>
                </form>
            </div>
            
        </div>

        <div class="Ticket-cadre">   
            <h3>Title:</h3><p>{{$project->title}}</p>
            <h3>Client:</h3><p> {{$project->client}}</p>
            <h3>Description:</h3><p>{{$project->description}}</p>

            <table class="Table-ticket">
                <tr>
                    <th colspan="2">Project Details</th>
                </tr>
                <tr>
                    <td>Contract : </td>
                    <td><button class="Edit-button">Download Contract</button></td>
                </tr>
                <tr>
                    <td>Number of associated tickets: </td>
                    <td>{{$project->ticketNumber}}🧾</td>
                </tr>
                <tr>
                    <td>Tickets en cours: </td>
                    <td>{{$project->workingTickets}}</td>
                </tr>
                <tr>
                    <td>Tickets terminés:</td> 
                    <td>{{$project->waitingTickets}}</td>
                </tr>
            </table>

            <table class="Table-ticket">
                <tr>
                    <th colspan="2">Associated Tickets</th>
                </tr>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td><a href="{{route('tickets.Ticket',["id" => $ticket->id])}}l">{{$ticket->title}}</a></td>
                        <td>{{$ticket->statut}}</td>
                    </tr>
                @endforeach
                
                

    </section>

    <script src="../JS/Header.js"></script>
 

    @endsection