$('#createCustomer').click(function() {
    $.ajax({
            url: $(this).data('route'),
            type: 'GET',


        })
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            $('.modal-area').append(response);
            $('#modalFormCreateCustomer').modal('show');
        });
});
$(document).on('click', '.customer-edit', function(e) {
    e.preventDefault();
    var that = $(this),
        route = that.data('route');
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

$(document).on('submit', '#mainFormCreateCutomer', function(e) {
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
            $.map(data.responseJSON.message, function(value) {
                value.forEach(element => {
                    toastr.error(element, {
                        timeOut: 5000
                    })
                });
            });
        })
        .done(function(response) {
            toastr.success(response.message, {
                timeOut: 5000
            })
            $('#modalFormCreateCustomer').modal('hide');
            // closeModalRender();
            $('#tableCustomer tbody').prepend(response.data);
            if (response.is_contract) {
                $('select#customer').append('<option value="' + response.customer.id + '">' + response.customer.fullname + '</option>');
                $('select#customer').val(response.customer.id).trigger('change');
            }
            if (response.is_contract_table) {
                console.log(response);
                $('#table-customer tbody').prepend(response.data);
            }
        });
});

$(document).on('submit', '#mainFormEdit', function(e) {
    e.preventDefault();
    var form = $(this),
        replace = '#tableCustomer tbody tr.item-' + form.find('input[name="id"]').val();
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
            toastr.success(response.message, {
                timeOut: 5000
            })
            $('#modalFormEdit').modal('hide');
            // closeModalRender();
            $(replace).replaceWith(response.data);
        });
});

$(document).on('click', '.customer-delete', function(e) {
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
        .fail(function(data) {
            toastr.error('Vui lòng tải lại trang', {
                timeOut: 5000
            })
        })
        .done(function(response) {
            toastr.success('Thực hiện thành công', {
                timeOut: 5000
            })
            $('#tableCustomer tbody tr.item-' + response.id).remove();
        });
});

$(document).ready(function() {
    $('#tableCustomer tfoot th.yes').each(function() {
        var title = $(this).text();
        $(this).html('<input class="form-control form-control-sm form_special" type="text" style="width: 100%" placeholder="' + title + '" />');
    });

    // DataTable
    var table = $('#tableCustomer').DataTable({
        initComplete: function() {
            // Apply the search
            this.api().columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });

            // this.api().columns([4, 5, 6]).every(function() {
            //     var column = this;
            //     var info_1 = $('<select class="form-control form-control-sm form_special" type="text" style="width: 100%" ><option value="">--Tất cả--</option></select>');
            //     var select = info_1
            //         .appendTo($(column.footer()).empty())
            //         .on('change', function() {
            //             var val = $.fn.dataTable.util.escapeRegex(
            //                 $(this).val()
            //             );

            //             column
            //                 .search(val ? '^' + val + '$' : '', true, false)
            //                 .draw();
            //         });

            //     column.data().unique().sort().each(function(d, j) {
            //         select.append('<option value="' + d + '">' + d + '</option>')
            //     });
            // });
        },
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ],
        columnDefs: [{
            orderable: false,
            // className: 'select-checkbox',
            targets: [0, 1]
        }],
        select: {
            selector: 'td:first-child',
            style: 'multi'
        },
        language: {
            "search": "",
            "lengthMenu": "",
            "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ ",
            "zeroRecords": "Không kiếm ra được kết quả nào",
            "infoFiltered": "",
            "infoEmpty": "Không có gì để hiển thị",
            "paginate": {
                "first": "Đầu trang",
                "last": "Cuối trang",
                "next": "Trang tiếp theo",
                "previous": "Trang trước"
            },
        },
    });

});

$(document).ready(function() {
    var DT1 = $('#table_khach_hang').DataTable();
    $("#select-all").on("click", function(e) {
        if ($(this).is(":checked")) {
            DT1.rows().select();
        } else {
            DT1.rows().deselect();
        }
    });
});