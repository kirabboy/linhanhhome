$(document).on('submit', '#create-room-form', function(e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: actionUrl,
            type: 'POST',
            data: form.serialize(),
        })
        .fail(function(data) {
            console.log(data);
            $.each(data.responseJSON.message, function(key, value) {
                toastr.error(value, {
                    timeOut: 5000
                })
            });
        })
        .done(function(response) {
            console.log(response);
            $('#modal-form').modal('hide');
            $('.list-room-' + form.find('select[name="floor_id"]').val()).append(response);
            toastr.success('Thêm phòng thành công', {
                timeOut: 5000
            })
        });
});
$(document).on('submit', '#edit-room-form', function(e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            url: actionUrl,
            type: 'PUT',
            data: form.serialize(),
        })
        .fail(function(data) {
            console.log(data);
            $.each(data.responseJSON.message, function(key, value) {
                toastr.error(value, {
                    timeOut: 5000
                })
            });
        })
        .done(function(response) {
            console.log(response);
            $('#modal-form').modal('hide');
            toastr.success('Sửa phòng thành công', {
                timeOut: 5000
            });
            $('#room-' + response['room'].id).text(response['room'].name);
            $('#room-' + response['room'].id).trigger('click');
        });
});