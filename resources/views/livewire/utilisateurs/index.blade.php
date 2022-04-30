<div wire:ignore.self>


    @if ($currentPage == PAGECREATEFORM)
        @include('livewire.utilisateurs.create')

        {{-- @endif --}}
    @elseif ($currentPage == PAGEEDITFORM)
        @include('livewire.utilisateurs.edit')

        {{-- @endif --}}
    @else
        {{-- ($currentPage==PAGELIST) --}}

        @include('livewire.utilisateurs.liste')
    @endif



    {{-- @if ($isBtnAddClicked)

        @include("livewire.utilisateurs.create")

    @else

        @include("livewire.utilisateurs.liste")

    @endif --}}

</div>

<script>
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
                    @this.deleteUser(event.detail.message.data.user_id)
                }
                else {
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
</script>
{{-- voir le composant livewire utilisateurs.php la fonction confirmDelete() --}}
