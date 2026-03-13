<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    public function Profil()
    {
        return view('profil.Profil', [
            "User" => User::where('id', auth()->id())->first(),
        ]);
    }

}