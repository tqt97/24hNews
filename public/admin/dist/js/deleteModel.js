function actionDelete (event) {
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
                        );
                    }
                },
                error: function () {

                }
            });
        }
    });
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete);
});

$(document).ready(function () {
    $('#master').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    $('.delete_all').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        if (allVals.length <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Không có bản ghi được chọn !'
            });
        } else {
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
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: 'DELETE',
                        url: $(this).data('url'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function (data) {
                            if (data.code == 200) {
                                $(".sub_chk:checked").each(function () {
                                    $(this).parents("tr").remove();
                                });
                                Swal.fire(
                                    'Đã xóa !',
                                    'Bản ghi đã bị xóa.',
                                    'success'
                                );
                            } else if (data[ 'error' ]) {
                                alert(data[ 'error' ]);
                            } else {
                                alert('Whoops Đã có lỗi xảy ra!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function (index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            });
        }
    });
    $('.restore_all').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        if (allVals.length <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Không có bản ghi được chọn !'
            });
        } else {
            Swal.fire({
                title: 'Bạn có chắc chắn khôi phục ?',
                text: "Khôi phục bản ghi !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy bỏ',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.value) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: 'GET',
                        url: $(this).data('url'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function (data) {
                            if (data.code == 200) {
                                $(".sub_chk:checked").each(function () {
                                    $(this).parents("tr").remove();
                                });
                                Swal.fire(
                                    'Khôi phục !',
                                    'Bản ghi đã được khôi phục.',
                                    'success'
                                );
                            } else if (data[ 'error' ]) {
                                alert(data[ 'error' ]);
                            } else {
                                alert('Whoops Đã có lỗi xảy ra!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function (index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            });
        }
    });
});
