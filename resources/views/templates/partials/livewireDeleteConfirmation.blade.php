<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).on('click', '{{ $buttonSelector ?? '.delete-button' }}', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure to delete this record?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#226DAE',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.value) {

                // In delete buttons, set the delete-listener to avoid conflict
                let deleteEventListener = $(this).data("delete-listener");

                if( !deleteEventListener )
                    deleteEventListener = 'deleteItem';

                window.livewire.emit(  deleteEventListener , $(this).data("id"))
            }
        })
    })
</script>
