<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $isBtnAddClicked = false;

    protected $rules = [
        'newUser.nom' => 'required',
        'newUser.prenom' => 'required',
        'newUser.email' => 'required|email|unique:users,email',
        'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
        'newUser.pieceIdentite' => 'required',
        'newUser.sexe' => 'required',
        'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',

    ];

    // protected $messages = [
    //     'newUser.nom.required' => "Le nom de l'utilisateur est requis.",
    // ]; Cette fonction pour personnaliser le message d'erreur

    // protected $validationAttributes = [
    //     'newUser.telephone1' => 'phone number',
    //     'newUser.prenom' => 'first name'
    // ]; cette fonction pour remplacer le nom que donne laravel à notre champs dans le message d'erreur par défaut

    public $newUser = array();

    public function render()
    {
        return view('livewire.utilisateurs.index', [
            "users"=>User::latest()->paginate(10)
        ])
        ->extends('layouts.master')
        ->section("contenu");
    }

    // VOIR CREATE.BLADE.PHP ET LISTE.BLADE.PHP

    public function goToAddUser(){
        $this->isBtnAddClicked = true;
    }

    public function goToListUser(){
        $this->isBtnAddClicked = false;
    }

    public function addUser(){
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes= $this->validate(); // si les régles pré-citées ci-dessus sont réspectées cette fonction passe à l'éxecution du reste du code c'est-à-dire le dump sinn il va s'arrêter ici et elle va rien faire
        // la fonction validate() nous renvois un tableau des attributs qui ont été validés
        $validationAttributes["newUser"]["password"] = "password";

        //dump($validationAttributes);
        // Ajouter un nouvel utilisteurs
        User::create($validationAttributes["newUser"]);

        $this->newUser = []; // cette derniere pour vider le formulaire après avoir créer avec sccès un user

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur créé avec succès!"]); // ceci pour afficher le message qui nous permet de savoir que l'utilisateur a été créé avec succés voir create.blade.php
    }
}
