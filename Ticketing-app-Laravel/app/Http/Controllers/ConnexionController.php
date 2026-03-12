<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    public function connexion()
    {
        return view('connexion.Connexion');
    }
    
    public function Forgotten()
    {
        return view('connexion.Forgotten-Password');
    }
    public function Inscription()
    {
        return view('connexion.Inscription');
    }
    
}