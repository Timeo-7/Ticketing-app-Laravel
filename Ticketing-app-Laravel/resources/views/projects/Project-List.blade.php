@extends('layout.main')

@section('content')

<section class="Projects-List">
           
         <div>
            <a class="new-ticket-button" href="{{ route('projects.ProjectForm') }}">+New Project</a>
        </div>

        <div class="access-list">
                <div class="cadre">   
                    <p>Projects</p>
                    @foreach ($projects as $project)

                    <a class="projects-fast-access" href="{{ route('projects.Project') }}" >
                         <p>{{$project->title}}</p>
                         <p>{{$project->workingTickets}}x🧾</p>
                    </a>
                    

                    @endforeach

                </div>
    </section>
    
    <script src="../JS/Header.js"></script>

@endsection