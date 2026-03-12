@extends('layout.Connexion')

@section('content')

    <section class="connexion-form">
        <form id="submitform_connexion" action="{{ route('connexion.Connexion') }}" method="GET" novalidate>
            <h2>Forgotten Password</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <div id="email_error" class="error-text titanic">L'Email est invalide</div>
            <br>
            <button type="submit" class="Submit-button">Envoyer</button>
            <a href="{{ route('connexion.Connexion') }}">Se connecter</a>
        </form>
        <div class="ValidForms titanic">
            <p>Email Send</p>
        </div>

    </section>

    <script src="{{ asset('js/Forgotten-Password.js') }}"></script>

@endsection