<div class="row p-4 pt-5">

    <div class="col-md-6">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de création d'un nouvel utilisateur</h3>
        </div>


            <form role="form" wire:submit.prevent="addUser()">
                <div class="card-body">
{{--                        <div class="row">
                        <div class="col-6">

                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" class="form-control">
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>--}}

                    <div class="d-flex">

                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input type="text" wire:model="newUser.nom" class="form-control @error('newUser.nom') is-invalid @enderror">

                            @error('newUser.nom')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Prénom</label>
                            <input type="text" wire:model="newUser.prenom" class="form-control @error('newUser.prenom') is-invalid @enderror">

                          @error('newUser.prenom')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Sexe</label>
                        <select wire:model="newUser.sexe" class="form-control @error('newUser.sexe') is-invalid @enderror">
                            <option value="">-----</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>

                        @error('newUser.sexe')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Adresse e-mail</label>
                        <input type="text" class="form-control @error('newUser.email') is-invalid @enderror" wire:model="newUser.email">

                        @error('newUser.email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="d-flex">

                        <div class="form-group flex-grow-1 mr-2">
                            <label>Téléphone 1</label>
                            <input type="text" class="form-control @error('newUser.telephone1') is-invalid @enderror" wire:model="newUser.telephone1">

                            @error('newUser.telephone1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Téléphone 2</label>
                            <input type="text" class="form-control" wire:model="newUser.telephone2">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Pièce d'identité</label>
                        <select class="form-control @error('newUser.pieceIdentite') is-invalid @enderror" wire:model="newUser.pieceIdentite">
                            <option value="">-----</option>
                            <option value="CNI">CNI</option>
                            <option value="PASSPORT">PASSPORT</option>
                            <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                        </select>

                        @error('newUser.pieceIdentite')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Numéro pièce d'identité</label>
                        <input type="text" class="form-control @error('newUser.numeroPieceIdentite') is-invalid @enderror" wire:model="newUser.numeroPieceIdentite">
                        @error('newUser.numeroPieceIdentite')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="text" class="form-control" disabled placeholder="Password" wire:model="newUser.password">
                    </div>

                </div>

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enregister</button>
                <button type="button" wire:click="goToListUser()" class="btn btn-danger">Retourner à la liste des utilisateurs</button>

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.addEventListener("showSuccessMessage", event => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            toast: true,
            title: event.detail.message || "Opération effectuée avec succès!",
            showConfirmButton: false,
            timer:3000
        })
    })
</script>
{{-- voir le composant livewire utilisateurs.php la fonction addUser() --}}
