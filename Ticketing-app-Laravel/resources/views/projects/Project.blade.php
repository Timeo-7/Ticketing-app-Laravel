 @extends('layout.main')

@section('content')

    <section>

        <div class="Ticket-Header">  

            <div>
                <a class="back-button" href="{{ route('projects.ProjectList') }}">← Back to Projects List</a>
            </div>

            <div class="Right-buttons">
                <div >
                    <button class="Edit-button">✏️ Edit Project</button>
                </div>
                <div >
                    <button class="Supression-button">Supprimer le projet</button>
                </div>
            </div>
            
        </div>

        <div class="Ticket-cadre">   
            <h3>Client:</h3><p> Client Name</p>
            <h3>Colaborators:</h3><p>Colaborators Names</p>
            <h3>Project Name:</h3><p>Project Name</p>
            <h3>Description:</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

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
                    <td>25x🧾</td>
                </tr>
                <tr>
                    <td>Tickets en cours: </td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Tickets terminés:</td> 
                    <td>15</td>
                </tr>
            </table>

            <table class="Table-ticket">
                <tr>
                    <th colspan="2">Associated Tickets</th>
                </tr>
                <tr>
                    <td><a href="./Tickets.html">Ticket 1</a></td>
                    <td>⏳ En cours</td>
                </tr>
                <tr>
                    <td><a href="./Tickets.html">Ticket 2</a></td>
                    <td>✅ Terminé</td>
                </tr>
                

    </section>

    <script src="../JS/Header.js"></script>
 

    @endsection