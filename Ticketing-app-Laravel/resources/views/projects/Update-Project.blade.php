@extends('layout.main')

@section('content')


<section>

         <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{route("projects.Project", $project->id)}}">← Back to Projects List</a>
            </div>
            
        </div>

        <div>
            <form id="submitform_project" action="{{route("projects.Update", $project->id)}}" method="POST">
                @csrf
                
                <label for="project-title">Project Title:</label>
                <input type="text" id="project-title" name="project-title" value="{{$project->title}}">
                <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>
                <br>
                <label for="project-client">Client Name:</label>
                <input type="text" id="project-client" name="project-client" value="{{$project->client}}">
                <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>
                <br>
                <label for="project-description">Description:</label>
                <textarea id="description" name="description" value="{{$project->description}}"></textarea>
                <br>
                <label for="project-file">Contract : <input type="text" id="project-file" name="contract"  {{-- accept=".pdf,.doc,.docx" --}}></label>
                <div id="file_error" class="error-text titanic">Le contrat est obligatoire.</div>
                    
                <button type="submit" class="Submit-button">Update Project</button>
                
            </form>
        </div>

        <div class="ValidForms titanic">
            <p>Formulaire envoyé</p>
        </div>


    </section>
@endsection