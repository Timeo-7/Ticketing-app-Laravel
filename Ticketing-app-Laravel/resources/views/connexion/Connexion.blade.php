@extends('layout.Connexion')

@section('content')

 <section class="connexion-form">
        <form id="submitform_connexion" action="{{ route('connexion.Store') }}" method="POST" novalidate>
            @csrf
            <h2>Connexion</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <div id="email_error" class="error-text titanic">L'Email est invalide</div>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div id="password_error" class="error-text titanic">Le Mot de passe doit faire plus de 8 caractères et contenir au moins un chiffre et une lettre.</div>
            <br>
            <button type="submit" class="Submit-button">Login</button>
            <a href="{{ route('connexion.Forgotten') }}">Forgotten password</a> 
        </form>

        <div class="ValidForms titanic">
            <p>Connexion</p>
        </div>

    </section>

    <script src="{{ asset('js/Connexion.js') }}"></script>
@endsection