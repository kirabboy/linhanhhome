$(document).on('submit', '#form-create-invoice', function(e) {
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
            if (response['status']) {
                toastr.success(response['message'], {
                    timeOut: 5000
                })
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                })
            }

            $('#modal-form').modal('hide');

        });
});
$(document).on('submit', '#form-edit-invoice', function(e) {
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
            if (response['status']) {
                toastr.success(response['message'], {
                    timeOut: 5000
                })
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                })
            }

            $('#modal-form').modal('hide');

        });
});