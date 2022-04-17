<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //avant qu'une requête ne soit envoyée au controlleur cette class middleware verifie d'abord l'identité l'utilisateur on est danst le /home avant que le routage nous envoi au controlleurqui retourne la page index il execute d'abord ce constructeur qui contient la fonction middlware qui nous envoi à la page de login pour vérifier d'abord l'identé de celui qui tente voir son dashbord
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
