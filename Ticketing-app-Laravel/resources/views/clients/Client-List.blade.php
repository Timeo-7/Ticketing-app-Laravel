@extends('layout.main')

@section('content')
    <section class="Projects-List">

        <div class="access-list">
                <div class="cadre">   
                    <p>Clients</p>

                    <a class="clients-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Client 1</p>
                         <p>25x🧾</p>
                    </a>
                    <a class="clients-fast-access" href="{{ route('projects.Project') }}" >
                         <p>Client 2</p>
                         <p>36x🧾</p>
                    </a>

                </div>
    </section>

    <script src="../JS/Header.js"></script>
@endsection