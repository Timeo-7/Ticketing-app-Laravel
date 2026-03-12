@extends('layout.Connexion')

@section('content')

<form id="submitform_connexion" action="{{ route('connexion.Connexion') }}" method="GET" novalidate>
            <h2>Inscription</h2>
            <label for="type_inscription">Type:</label>
                <select type="text" id="type_inscription" name="type_inscription">
                    <option value="project1">Client</option>
                    <option value="project1">Colaborator</option>
                    <option value="project2">Administrator</option>
                </select>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <div id="email_error" class="error-text titanic">L'Email est invalide</div>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div id="password_error" class="error-text titanic">Le Mot de passe doit faire plus de 8 caractères et contenir au moins un chiffre et une lettre.</div>
            <br>
            <label for="password">Password Verification:</label>
            <input type="password" id="passwordVerif" name="passwordVerif">
            <div id="passwordVerif_error" class="error-text titanic">Le mot de passe ne correspond pas.</div>
            <br>
            <button type="submit" class="Submit-button">Creer</button>
            <a href="{{ route('connexion.Connexion') }}">Se connecter</a>
        </form>

        <div class="ValidForms titanic">
            <p>Inscription réussie</p>
        </div>

        <script src="{{ asset('js/Inscription.js') }}"></script>

@endsection