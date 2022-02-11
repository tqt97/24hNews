function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);

    Swal.fire({
        title: 'Bạn có chắc chắn xóa ?',
        text: "Bản ghi sẽ bị xóa vĩnh viễn!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Hủy bỏ',
        confirmButtonText: 'Xóa bản ghi'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: urlRequest,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().remove();
                        Swal.fire(
                            'Đã xóa !',
                            'Bản ghi đã bị xóa.',
                            'success'
                        )
                    }

                },
                error: function () {

                }
            });


        }
    })

}

$(function () {
    $(document).on('click', '.action_delete', actionDelete);
});
