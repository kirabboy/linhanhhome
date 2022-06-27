$(document).on('submit', '#form-create-contract-service', function(e) {
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
            $('#modalFormCreate').modal('hide');
            if (response['status']) {
                toastr.success(response['message'], {
                    timeOut: 5000
                });
                $('#service-detail-area').empty().append(response['html_service_detail']);
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                });
            }
            $('.modal-area').empty();
        });
});
$(document).on('submit', '#form-edit-contract-service', function(e) {
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
            $('#modalFormCreate').modal('hide');
            if (response['status']) {
                toastr.success(response['message'], {
                    timeOut: 5000
                });
                $('#service-detail-area').empty().append(response['html_service_detail']);
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                });
            }
            $('.modal-area').empty();
        });
});