$(function(){
    $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Cette action est irréversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        Swal.fire(
                            'Supprimé!',
                            'ca a été supprimé.',
                            'success'
                        ).then(() => {
                            location.reload(); // Recharger la page après la suppression
                        });
                    },
                    error: function(response) {
                        Swal.fire(
                            'Erreur!',
                            'Une erreur s\'est produite lors de la suppression.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
