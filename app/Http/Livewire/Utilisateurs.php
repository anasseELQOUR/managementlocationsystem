<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Utilisateurs extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    //public $isBtnAddClicked = false;

    public $currentPage = PAGELIST;

    public $newUser = array();
    public $editUser = array();

    public $rolePermissions = array(); // c cette variable qui va récupérer l'ensemble des rôles et permissions

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

        Carbon::setLocale("fr");

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


    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        //dump($this->editUser);
        $this->currentPage = PAGEEDITFORM;

        $this->populateRolePermissions();
    }


    public function populateRolePermissions()
    {
        $this->rolePermissions["roles"] = [];
        $this->rolePermissions["permissions"] = [];

        // la logique pour charger les r$oles et les permissions

        $mapForCB = function ($value) {
            return $value["id"];
        };

        $roleIds = array_map($mapForCB, User::find($this->editUser["id"])->roles->toarray()); // cette variable va en faite récupérer la valeur correspondante à l'Id user dans la table rôle c-à-d on a id = 2 dans la table user lui correspond le rôle admin autrement dit cette variable a pour role de récupérer le role de chaque utilisateur pour se faire on doit unire les deux tables
        // la fonction roles() c la fonction qui matérialse la relation entre les deux tables users et roles voir dans user.php en profitant de cette relation on peut récupérer les différents roles des different utilisateur en se basant sur l'union des dex tables users et roles

        //dump(User::find($this->editUser["id"])->roles->toarray());

        //dump(User::find($this->editUser["id"])->roles->toarray());


        foreach (Role::all() as $role) {
            if (in_array($role->id, $roleIds)) {
                array_push($this->rolePermissions["roles"], ["role_id" => $role->id, "role_nom" => $role->nom, "active" => true]);
            } else {
                array_push($this->rolePermissions["roles"], ["role_id" => $role->id, "role_nom" => $role->nom, "active" => false]);
            }
        }

        // le foreach ici pour recupérer tous les rôles qui existe dans la table roles et par la suite va comparer ces dernier avec le role de l'utilisateur récupérer dans la table $roleIds s' ils sont pareil cette boucle attribuer à la table rolePermissions les valeurs suivantes l'identifiant de l'utilisateur le role de l'utilisateure et active sera un true dans le cas contraire cette boucle avec attribuer à a même table les mêmes valeurs sauf que pr active sera un false


        $permissionIds = array_map($mapForCB, User::find($this->editUser["id"])->permissions->toarray());


        foreach (Permission::All() as $permission) {
            if (in_array($permission->id, $permissionIds)) {
                array_push($this->rolePermissions["permissions"], ["permission_id" => $permission->id,  "permission_nom" => $permission->nom, "active" => true]);
            } else {
                array_push($this->rolePermissions["permissions"], ["permission_id" => $permission->id, "permission_nom" => $permission->nom, "active" => false]);
            }
        }
          //dump($this->rolePermissions);
    }

    public function updateRoleAndPermissions(){
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete(); //cette ligne pour récuperer tous les roles d'un utilisateur et les supprimer de la base de données afin d'appliquer les modifications
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete(); // même topo cette ligne pour récuperer toutes les permissions d'un utilisateur et les supprimer de la base de données afin d'appliquer la modification
        // la boucle suivante va récupérer l'id de l'utilisateur qu'on veut modifier et va l'attribuer l'id du rôle qu'on va lui ajouter à traver a relation rôle()
        foreach($this->rolePermissions["roles"] as $role){
            if($role["active"]){
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
            }
        }

        // même topo pour cette boucle qui va aussi récuperer l'id de l'utilisateur qu'on veut modifier et va l'attribuer l'id du permission qu'on va lui associer à traver la realtion permissions()
         foreach($this->rolePermissions["permissions"] as $permission){
             if($permission["active"]){
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]);
             }

        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Rôles et permissions mis à jour avec succès!"]); // ceci pour afficher le message qui nous permet de savoir que l'utilisateur a été créé avec succés voir create.blade.php

    }

    public function goToListUser()
    {
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function addUser()
    {
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate(); // si les régles pré-citées ci-dessus sont réspectées cette fonction passe à l'éxecution du reste du code c'est-à-dire le dump sinn il va s'arrêter ici et elle va rien faire
        // la fonction validate() nous renvois un tableau des attributs qui ont été validés
        $validationAttributes["newUser"]["password"] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

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

    public function confirmPwdReset()
    {
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" => [
            "text" => "Vous êtes sur le point de rénitialiser le mot de passe de cet utilisateur. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning"
        ]]);
    }

    public function resetPassword()
    {
        User::find($this->editUser["id"])->update(["password" => Hash::make(DEFAULTPASSWORD)]);

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
