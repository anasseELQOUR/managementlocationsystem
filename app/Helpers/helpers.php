<?php

use Illuminate\Support\Str;

function userFullName(){
    return auth()->user()->prenom ." ". auth()->user()->nom;
}


// cette fonctions va nous permettre de comparer deux chaînes de caractères
function contains($container, $contenu){
    return Str::contains($container, $contenu);
}

// cette fonction va comparer le chemin entrer en paramétre avec le chemin actuel à l"aide de la fonction précedente contains() si ils sont pareils elle va retourner menu-open sinn le menu restera fermé pour de bon cette fonction est appliquée au niveau de menu.blade.php
function setMenuOpen($route){
    $routeActuel = Request()->route()->getName();
    if(contains($routeActuel, $route)){
        return "menu-open";
    }
    return "";
}

// cette fonction va faire le même travail que la précedente sauf que celle-là on lui a passer le style en paramètre $classe et il va retourner la classe tel qu'elle lui a été entré en param la différence avec la précedente elle va tjrs retourner le menu-open

function setMenuClass($route, $classe){
    $routeActuel = Request()->route()->getName();
    if(contains($routeActuel, $route)){
        return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = Request()->route()->getName();
    if($routeActuel === $route){
        return 'active';
    }
    return "";
}


// cette fonction serà lister les rôle des utilisateurs si par exemple l'utilisateur a un seul rôle va retourner un seul rôle par contre si l'utilisateur possède +ieurs rôles elle va retourner la concat de l'ensemble de ses rôles
function getRolesName(){
    $rolesName = "";
    $i = 0;
    foreach (auth()->user()->roles as $role){
        $rolesName .= $role->nom;

        if ($i < sizeof(auth()->user()->roles) - 1){
            $rolesName .= ", ";
        }
        $i++;
    }
    return $rolesName;
}



