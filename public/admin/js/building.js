
$('#btn-create-building').click(function() {
    $.ajax({
            url: $(this).data('url'),
            type: 'GET'
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('.modal-area').append(response);
            $('#modalFormCreate').modal('show');
        });
});
$(document).on('click', '.building-edit', function(e) {
    e.preventDefault();
    var that = $(this), route = that.data('route');
    $.ajax({
            url: route,
            type: 'GET'
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('.modal-area').append(response);
            
            $('#modalFormEdit').modal('show');
        });
});
$(document).on('submit', '#mainFormCreate', function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    $.ajax({
            url: actionUrl,
            type: 'POST',
            data: form.serialize(),
        })
        .fail(function(data) {
            $.map(data.responseJSON.message, function(value) {
                value.forEach(element => {
                    toastr.error(element, {
                        timeOut: 5000
                    })
                });
            });
        })
        .done(function(response) {
            toastr.success('Thực hiện thành công', {
                timeOut: 5000
            })
            $('#modalFormCreate').modal('hide');
            closeModalRender();
            $('#afterSubmit').prepend(response);
        });
});

$(document).on('submit', '#mainFormEdit', function(e) {
    e.preventDefault();
    var form = $(this), replace = '.building-item-'+form.find('input[name="id"]').val();
    var actionUrl = form.attr('action');
    $.ajax({
            url: actionUrl,
            type: 'PUT',
            data: form.serialize(),
        })
        .fail(function(data) {
            $.map(data.responseJSON.message, function(value) {
                value.forEach(element => {
                    toastr.error(element, {
                        timeOut: 5000
                    })
                });
            });
        })
        .done(function(response) {
            toastr.success('Thực hiện thành công', {
                timeOut: 5000
            })
            $('#modalFormEdit').modal('hide');
            closeModalRender();
            $(replace).replaceWith(response);
        });
});
$(document).on('click', '.building-delete', function(e) {
    e.preventDefault();
    if(!confirm('Bạn có chắc là muốn thực hiện ? ')){
        return;
    }
    var that = $(this), route = that.data('route');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: route,
            type: 'DELETE'
        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            toastr.success('Thực hiện thành công', {
                timeOut: 5000
            })
            $('.building-item-' + response.id).remove();
        });
});

