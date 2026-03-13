<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    public function connexion()
    {
        return view('connexion.Connexion');
    }

     public function Store(Request $request)
    {
        dd($resquest);
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        return redirect()->route('dashboard.Dashboard');
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