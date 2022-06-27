function createRoom(e) {
    $.ajax({
            url: $(e).data('url'),
            data: {
                'building_id': $(e).data('building_id'),
                'floor_id': $(e).data('floor_id'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('.modal-area').append(response);
            $('#modal-form').modal('show');
        });
}

function createInvoice(e) {
    $.ajax({
            url: $(e).data('url'),
            data: {
                'id_room': $(e).data('id_room'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);

            if (response['status']) {
                $('.modal-area').empty().append(response['message']);
                $('#modal-form').modal('show');
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                })
            }

        });
}

function createContract(e) {

    $.ajax({
            url: $(e).data('url'),
            data: {
                'room_id': $(e).data('room_id'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            if (response['status']) {
                $('.modal-area').append(response['message']);
                $('#modalFormCreateContract').modal('show');
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                })
            }

        });

}

function createContractEarnest(e) {
    $.ajax({
            url: $(e).data('url'),
            data: {
                'room_id': $(e).data('room_id'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            if (response) {
                console.log(response);
                $('.modal-area').append(response);
                $('#modalFormCreate').modal('show');
            } else {
                toastr.error('Hợp đồng đã tồn tại', {
                    timeOut: 5000
                })
            }

        });
}
$(document).on('click', '.btn-change-status-room', function() {
    id_room = $(this).data('room_id');
    $.ajax({
            url: $(this).data('url'),
            data: {
                'id_room': $(this).data('room_id'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('#room-' + id_room).trigger('click');
            $('.modal-area').empty().append(response);
            $('#modal-form').modal('show');
        });
});
$(document).on('click', '.btn-edit-room', function() {
    id_room = $(this).data('id_room');
    $.ajax({
            url: $(this).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('#room-' + id_room).trigger('click');
            $('.modal-area').empty().append(response);
            $('#modal-form').modal('show');
        });
});
$(document).on('click', '.btn-create-room', function() {
    $.ajax({
            url: $(this).data('url'),
            data: {
                'id_contract': $(this).data('id_contract'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);

            $('.modal-area').empty().append(response);
            $('#modalFormCreate').modal('show');
        });
});
$(document).on('click', '.btn-edit-contract-earnest', function() {
    $.ajax({
            url: $(this).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);

            $('.modal-area').empty().append(response);
            $('#modalFormCreate').modal('show');
        });
});

function editContractService(e) {

    $.ajax({
            url: $(e).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);
            $('.modal-area').empty().append(response);
            $('#modalFormCreate').modal('show');
        });
}

function editInvoice(e) {

    $.ajax({
            url: $(e).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);
            $('.modal-area').empty().append(response['message']);
            $('#modal-form').modal('show');
        });
}

$('#tool-filter-status-room button').click(function() {
    $.ajax({
            url: $('#tool-filter-status-room').data('url'),
            data: {
                'status': $(this).data('status'),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('#building-detail').empty().append(response);
            $(".btn-room").first().trigger('click');

            console.log(response);
        });
});

function closeModal() {
    $('#modal-form').modal('hide');
}

function getRoomInfo(e) {
    $('.btn-room').removeClass('selected');
    $(e).addClass('selected');
    $.ajax({
            url: $(e).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('#nav_thong_tin_don_vi_thue').empty().append(response['html_room']);
            $('#nav_hop_dong_thue').empty().append(response['html_contract']);
            $('#nav_lich_su_hop_dong').empty().append(response['html_room_contract_history']);
            $('#nav_dat_coc_giu_cho').empty().append(response['html_contract_earnest']);
            $('#service-detail-area').empty().append(response['html_service_detail']);
            console.log(response);
        });
}
$(".btn-room").on('click', function() {
    $('#btn-tool-create-contract').data('room_id', $(this).data('room_id'));
    $('#btn-tool-create-contract-earnest').data('room_id', $(this).data('room_id'));
    $('#btn-tool-create-invoice').data('id_room', $(this).data('room_id'));
    $('#btn-tool-cancel-contract').data('id_room', $(this).data('room_id'));


});
$(".btn-room").first().trigger('click');


$(document).on('submit', '#form-change-status-room', function(e) {
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
            if (response['status']) {
                toastr.success(response['message'], {
                    timeOut: 5000
                })
                if (response['room_status'] == 3) {
                    $('#building-detail button.selected').removeClass('border-danger').addClass('border-secondary');
                } else {
                    $('#building-detail button.selected').removeClass('border-secondary').addClass('border-danger');

                }
            } else {
                toastr.error(response['message'], {
                    timeOut: 5000
                })
            }
        });
});

$(document).on('click', '.btn-edit-contract', function() {
    $.ajax({
            url: $(this).data('url'),
            data: {},
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            console.log(response);
            $('.modal-area').empty().append(response);
            $('#modal-form').modal('show');
        });
});
$(".modal").on('hide.bs.modal', function() {
    $('.modal-area').empty();
});