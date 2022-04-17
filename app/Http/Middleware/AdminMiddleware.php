<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) // cette fonction hundle()est une fonction qui fait le rôle d'un cheekpoint un poste de controle de tte requete envoyée en get avant de la léisser passer et c ici qu'on va d"finir les vérifications à faire
    {
        if(Gate::allows("admin")){

            return $next($request); // la classe gate permet de vérifier les autorisations accordées au niveau du code source
            // et qd à la middleware permet de vérifier les autorisations au niveau des routes
            // c se qd on a crée lorsqu'on a travaillé avec les authserviceprovider on travaillé avec la classe abstraue gate on créer au sein de cette dérnière la gate admin pour en faite vérifier si l'utilisateur qu'on crée est un admin elle retourne vrai ou faut   et au niveau de Adminmiddleware on veut selement récupérer la valeur que la autheserviceprovider va nous envoyyer
            // et ici le gate utilise la fonction allows pour la simple raisaon si la valeur retourné auprès du authserviceprovider est true cella va retourner $next.. ça veut dire laisser passer la requete
        }
        return redirect()->route("home");
        // ceci etant afin de rediriger sur la page d'accueil si l'utilisateur n'a pas le droit d'acc"der à un chemin donné en remplacement de la page retournée précedement qui retourne la page qui contient error 403 | THIS ACTION IS UNAUTHORIZED.
    }
}
// une fois qu'on a créer le middleware on doit dire à laravel qu'on crée un middleware et qui tu dois le prendre en compte à chaque fois qu'une requéte est entrée dans l'application en moyannat du kernel qui se trouve à la racine du dossier app
