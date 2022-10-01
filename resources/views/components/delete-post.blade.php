<script>
    //button create post event
    $('body').on('click', '#btn-delete-post', function () {

        var post_id = $(this).data('id');
        var token   = $("meta[name='csrf-token']").attr("content");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {

                console.log('data');

                //fetch to delete data
                $.ajax({
                    type: "GET",
                    url: `/posts/${post_id}`,
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){ 

                        //show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        //remove post on table
                        $(`#index_${post_id}`).remove();
                    }
                });
            }
        })
    });
</script>