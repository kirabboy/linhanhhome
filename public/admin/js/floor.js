$('.floor-edit').click(function (e) {
    e.preventDefault();
    var that = $(this),
        route = that.data('route');
    $.ajax({
            url: route,
            type: 'GET'
        })
        .fail(function (data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function (response) {
            $('.modal-area').append(response);

            $('#modalFormEdit').modal('show');
        });
});
$(document).on('submit', '#mainFormEdit', function (e) {
    e.preventDefault();
    var form = $(this),
        replace = '.floor-item-' + form.find('input[name="id"]').val() + ' .name span';
    var actionUrl = form.attr('action');
    $.ajax({
        url: actionUrl,
        type: 'PUT',
        data: form.serialize(),
    })
    .fail(function (data) {
        $.map(data.responseJSON.message, function(value) {
            value.forEach(element => {
                toastr.error(element, {
                    timeOut: 5000
                })
            });
        });
    })
    .done(function (response) {
        toastr.success(response.message, {
            timeOut: 5000
        })
        $('#modalFormEdit').modal('hide');
        closeModalRender();
        $(replace).text(response.data);
    });
});

$(document).on('click', '.floor-delete', function (e) {
    e.preventDefault();
    if (!confirm('Bạn có chắc là muốn thực hiện ? ')) {
        return;
    }
    var that = $(this),
        route = that.data('route');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: route,
        type: 'DELETE'
    })
    .fail(function (data) {
        toastr.error('Vui lòng tải lại trang', {
            timeOut: 5000
        })
    })
    .done(function (response) {
        toastr.success('Thực hiện thành công', {
            timeOut: 5000
        })
        $('.floor-item-' + response.id).remove();
    });
});

$('.show-quickly-room').click(function (e) {
    e.preventDefault();
    var that = $(this),
        route = that.data('route');
    $.ajax({
            url: route,
            type: 'GET'
        })
        .fail(function (data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function (response) {
            $('.modal-area').append(response);

            $('#modalShowQuickly').modal('show');
        });
});
