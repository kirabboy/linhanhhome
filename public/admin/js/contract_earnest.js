$(document).on('submit', '#mainFormCreateContractEarnest', function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');
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
            toastr.success(response.message, {
                timeOut: 5000
            })
            if (response.model.status == 1) {
                $('#building-detail button.selected').removeClass('border-danger').addClass('border-warning');

            }
            $('#room-' + response.model.id).trigger('click');

            $('#modalFormCreate').modal('hide');
            $('.modal-area').empty();
        });
});

$(document).on('submit', '#form-update-contract-earneast', function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');
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
            toastr.success(response.message, {
                timeOut: 5000
            })
            $('#modalFormCreate').modal('hide');
            $('.modal-area').empty();
        });
});