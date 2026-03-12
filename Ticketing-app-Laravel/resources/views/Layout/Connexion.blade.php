<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
</head>
<body>
    @include('layout.partials.header_Connexion')

    {{-- Je prévois l'injection de quelque chose ici (optionnel !) --}}
    @yield('content')
</body>
</html>