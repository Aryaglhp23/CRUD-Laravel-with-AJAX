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
                    data: {"_token": token},

                    success:function(response){ 

                        // response success
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: 'Data Berhasil di Hapus',
                            showConfirmButton: true
                        });

                        //remove post on table
                        $(`#index_${post_id}`).remove();
                    }
                });
            }
        })
    });
</script>