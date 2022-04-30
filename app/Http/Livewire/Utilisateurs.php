<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    //public $isBtnAddClicked = false;

    public $currentPage = "liste";

    public $newUser = array();
    public $editUser = array();

    // protected $rules = [
    //     'newUser.nom' => 'required',
    //     'newUser.prenom' => 'required',
    //     'newUser.email' => 'required|email|unique:users,email',
    //     'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
    //     'newUser.pieceIdentite' => 'required',
    //     'newUser.sexe' => 'required',
    //     'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',

    // ];

    // protected $messages = [
    //     'newUser.nom.required' => "Le nom de l'utilisateur est requis.",
    // ]; Cette fonction pour personnaliser le message d'erreur

    // protected $validationAttributes = [
    //     'newUser.telephone1' => 'phone number',
    //     'newUser.prenom' => 'first name'
    // ]; cette fonction pour remplacer le nom que donne laravel à notre champs dans le message d'erreur par défaut


    public function render()
    {
        return view('livewire.utilisateurs.index', [
            "users" => User::latest()->paginate(10)
        ])
            ->extends('layouts.master')
            ->section("contenu");
    }
    // , Rule::unique("users","email")->ignore($this->editUser['id']) ceci veut tt simplement dire que l'addresse email doit être unique sauf pour cet utillistauer à laquelle on veut modifier qlq chapms, c-a-d que cet utilisateur on va le mettre à jour mais on va le sauvegarder avec la même addresse email qui existe déjà sur la ligne d'enregistrement de ce derrnier/ si on garde la même addresse email laravel ne va pas considerer cela comme un problème par rapport à la contrainte d'unicité que nous avons définie sur le champs email et par la suite sur les autres chapms qui doivent respecter les contraintes d'unicités et si on tente de mettre une addresse email d'un autre utilisateur enregistré sur notre base de données il a le droit de nous dire que cette addresse appartient à un autre utilisateur c-a-d que cette addresse existe belle et bien sur notre base de données par la même analogie si vous avez sortie de vôtre propre maison et que vous tenter y rentrer on va te stoper et on va te prendre pour un valeur non tu vas rentrer sans problème parceque c'est votre maison et personne n'a le droit de vte stoper et ça n' doit te poser un problème à la base par contre si tu tentera de rentrer dans la maison d'un voisin et las on va te prendre pour un voleur et on va te stoper on va pas te laisser franchir la porte c'est un peu comme ça

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {
            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id'])],
                'editUser.telephone1' => ['required', 'numeric', Rule::unique("users", "telephone1")->ignore($this->editUser['id'])],
                'editUser.pieceIdentite' => 'required',
                'editUser.sexe' => 'required',
                'editUser.numeroPieceIdentite' => ['required', Rule::unique("users", "numeroPieceIdentite")->ignore($this->editUser['id'])],
            ];
        }
        return array(
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
            'newUser.pieceIdentite' => 'required',
            'newUser.sexe' => 'required',
            'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',
        );
    }

    // VOIR CREATE.BLADE.PHP ET LISTE.BLADE.PHP

    public function goToAddUser()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListUser()
    {
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        //dump($this->editUser);
        $this->currentPage = PAGEEDITFORM;
    }

    public function addUser()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate(); // si les régles pré-citées ci-dessus sont réspectées cette fonction passe à l'éxecution du reste du code c'est-à-dire le dump sinn il va s'arrêter ici et elle va rien faire
        // la fonction validate() nous renvois un tableau des attributs qui ont été validés
        $validationAttributes["newUser"]["password"] = "password";

        //dump($validationAttributes);
        // Ajouter un nouvel utilisteurs
        User::create($validationAttributes["newUser"]);

        $this->newUser = []; // cette derniere pour vider le formulaire après avoir créer avec sccès un user

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur créé avec succès!"]); // ceci pour afficher le message qui nous permet de savoir que l'utilisateur a été créé avec succés voir create.blade.php
    }

    public function updateUser()
    {

        //dump($this->editUser);
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();

        //dump($validationAttributes);

        User::find($this->editUser["id"])->update($validationAttributes["editUser"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur mis à jour avec succès!"]);
    }

    public function confirmPwdReset(){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de rénitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning"
        ]]);
    }

    public function resetPassword(){
        User::find($this->editUser["id"])->update(["password"=>Hash::make(DEFAULTPASSWORD)]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Mot de passe utilisateur a été réinitialiser avec succès!"]);

    }

    public function confirmDelete($name, $id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "user_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id)
    {
        User::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Utilisateur supprimé avec succès!"]);
    }
}
