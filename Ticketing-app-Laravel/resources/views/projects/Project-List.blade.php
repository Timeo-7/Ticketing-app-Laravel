@extends('layout.main')

@section('content')

<section class="Projects-List">
           
         <div>
            <a class="new-ticket-button" href="{{ route('projects.ProjectForm') }}">+New Project</a>
        </div>

        <div class="access-list">
                <div class="cadre">   
                    <p>Projects</p>

                    <a class="projects-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Project 1</p>
                         <p>25x🧾</p>
                    </a>
                    <a class="projects-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Project 2</p>
                         <p>36x🧾</p>
                    </a>

                </div>
    </section>
    
    <script src="../JS/Header.js"></script>

@endsection