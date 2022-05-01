<div class="row p-4 pt-5">

    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'édition utilisateur</h3>
            </div>


            <form role="form" wire:submit.prevent="updateUser()">
                <div class="card-body">

                    <div class="d-flex">

                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input type="text" wire:model="editUser.nom"
                                class="form-control @error('editUser.nom') is-invalid @enderror">

                            @error('editUser.nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Prénom</label>
                            <input type="text" wire:model="editUser.prenom"
                                class="form-control @error('editUser.prenom') is-invalid @enderror">

                            @error('editUser.prenom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Sexe</label>
                        <select wire:model="editUser.sexe"
                            class="form-control @error('editUser.sexe') is-invalid @enderror">
                            <option value="">-----</option>
                            <option value="0">Homme</option>
                            <option value="1">Femme</option>
                        </select>

                        @error('editUser.sexe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Adresse e-mail</label>
                        <input type="text" class="form-control @error('editUser.email') is-invalid @enderror"
                            wire:model="editUser.email">

                        @error('editUser.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="d-flex">

                        <div class="form-group flex-grow-1 mr-2">
                            <label>Téléphone 1</label>
                            <input type="text" class="form-control @error('editUser.telephone1') is-invalid @enderror"
                                wire:model="editUser.telephone1">

                            @error('editUser.telephone1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Téléphone 2</label>
                            <input type="text" class="form-control" wire:model="editUser.telephone2">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Pièce d'identité</label>
                        <select class="form-control @error('editUser.pieceIdentite') is-invalid @enderror"
                            wire:model="editUser.pieceIdentite">
                            <option value="">-----</option>
                            <option value="0">CNI</option>
                            <option value="1">PASSPORT</option>
                            <option value="2">PERMIS DE CONDUIRE</option>
                        </select>

                        @error('editUser.pieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Numéro pièce d'identité</label>
                        <input type="text"
                            class="form-control @error('editUser.numeroPieceIdentite') is-invalid @enderror"
                            wire:model="editUser.numeroPieceIdentite">
                        @error('editUser.numeroPieceIdentite')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Appliquer les modifications</button>
                    <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retourner à la liste des
                        utilisateurs</button>

                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe
                        </h3>
                    </div>

                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="" class="btn btn-link" wire:click.prevent="confirmPwdReset">Réinitialiser le
                                    mot de passe</a>
                                <span>(par défaut: "password")</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Rôles & permissions</h3>
                        <button class="btn bg-gradient-success" wire:click="updateRoleAndPermissions"><i class="fas fa-check"> Appliquer les modifications</i></button>
                    </div>

                    <div class="card-body">

                        <div id="accordions">
                            @foreach ($rolePermissions ["roles"] as $role)

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title flex-grow-1">
                                        <a href="#" data-parent="#accordions" aria-expanded="true">
                                            {{ $role["role_nom"] }}
                                        </a>
                                    </h4>
                                    <div
                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" wire:model.lazy="rolePermissions.roles.{{ $loop->index }}.active" {{-- ceci equivalent au rolePermissions["roles"][$loop->index][active]  et pour le wire:model est utilisé pour luer des inputs à des variables et pour lazy c'est pour appliquer des modification et que cette modification ne puisse s'appliquer partout et pour $loop->index pour récuperer en faite l'indice de la boucle cette variable est prédifinie même si on la déclare pas --}} @if($role["active"]) checked @endif id="customSwitch{{ $role["role_id"] }}">
                                        <label for="customSwitch{{ $role["role_id"] }}" class="custom-control-label"> {{ $role["active"]? "Activé" : "Désactivé" }}</label>
                                    </div>

                                </div>
                            </div>

                            @endforeach
                            {{-- @json($rolePermissions["roles"]) --}}
                        </div>

                    </div>

                    <div class="p-3">
                        <table class="table table-bordered">
                            <thead>
                                <th>Permissions</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($rolePermissions["permissions"] as $permission)
                                <tr>
                                    <td>{{ $permission["permission_nom"] }}</td>
                                    <td>
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" @if($permission["active"]) checked @endif wire:model.lazy="rolePermissions.permissions.{{ $loop->index }}.active" id="customSwitchPermission{{ $permission["permission_id"] }}">
                                            <label for="customSwitchPermission{{ $permission["permission_id"] }}" class="custom-control-label"> {{ $permission["active"]? "Activé" : "Désactivé" }}</label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- @json($rolePermissions["permissions"]) --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    window.addEventListener("showConfirmMessage", event => {
        Swal.fire({
            title: event.detail.message.title,
            text: event.detail.message.text,
            icon: event.detail.message.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                if (event.detail.message.data) {
                    @this.resetPassword()
                }
            }
        })
    })
</script>

<script>
    window.addEventListener("showSuccessMessage", event => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: event.detail.message || "Opération effectuée avec succès!",
            showConfirmButton: false,
            timer: 3000
        })
    })
</script> --}}
{{-- voir le composant livewire utilisateurs.php la fonction addUser() --}}
