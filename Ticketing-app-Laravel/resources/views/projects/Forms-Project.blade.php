@extends('layout.main')

@section('content')


       <section>

         <div class="Ticket-Header">   
            <div>
                <a class="back-button" href="{{ route('projects.ProjectList', $id) }}">← Back to Projects List</a>
            </div>
            
        </div>

        <div>
            <form id="submitform_project" action="{{ route('projects.Store', ["id" => $id]) }}" method="POST">
                @csrf

                <label for="project-title">Project Title:</label>
                <input type="text" id="project-title" name="project-title">
                <div id="title_error" class="error-text titanic">Le titre est obligatoire.</div>
                <br>
                <label for="client_id">Client:</label>
                <select id="client_id" name="client_id">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                </select>
                <div id="client_error" class="error-text titanic">Le client est obligatoire.</div>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
                <br>
                
                    
                <button type="submit" class="Submit-button">Create Project</button>
                
            </form>
        </div>

        <div class="ValidForms titanic">
            <p>Formulaire envoyé</p>
        </div>


    </section>

    {{-- <script src="{{ asset('js/Project-Forms.js') }}"></script> --}}

@endsection