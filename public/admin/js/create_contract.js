$(document).on('submit', '#form-create-contract', function(e) {
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
            $('#modalFormCreateContract').modal('hide');
            toastr.success(response['message'], {
                timeOut: 5000
            })
            $('#nav_thong_tin_don_vi_thue').empty().append(response['html_room']);
            $('#nav_hop_dong_thue').empty().append(response['html_contract']);
            $('#nav_lich_su_hop_dong').empty().append(response['htm_room_contract_history']);
            $('#service-detail-area').empty().append(response['html_service_detail']);
            if (response['status'] == 2) {
                $('#building-detail button.selected').removeClass('border-danger').addClass('border-success');

            }
        });
});
$(document).on('submit', '#form-edit-contract', function(e) {
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
            toastr.success(response['message'], {
                timeOut: 5000
            })
            $('#nav_thong_tin_don_vi_thue').empty().append(response['html_room']);
            $('#nav_hop_dong_thue').empty().append(response['html_contract']);
            $('#nav_lich_su_hop_dong').empty().append(response['htm_room_contract_history']);
            $('#service-detail-area').empty().append(response['html_service_detail']);
            // $('#building-detail button.selected').removeClass('border-danger').addClass('border-success');
        });
});