$('#customer').change(function() {
    $.ajax({
            url: $(this).data('url'),
            data: {
                customer_id: $(this).val(),
            },
            type: 'GET'
        })
        .fail(function(data) {
            console.log(data);
        })
        .done(function(response) {
            $('#id_number').val(response['identification_number']);
            $('#id_place').val(response['identification_place']);
            $('#email').val(response['email']);
            $('#phone').val(response['phone']);
            $('#id_date').val(yyyymmddToLocalDate(response['identification_time']));

            console.log(yyyymmddToLocalDate(response['identification_time']));
        });
});

function yyyymmddToLocalDate(isoString) {
    const [year, month, day] = isoString.split('-');
    return year + '-' + month + '-' + day;
}

$('#customer').select2({
    dropdownParent: $("#result-select2"),
    width: '100%',
    multiple: false,
    // minimumInputLength: 3,
    // dataType: 'json',
    // ajax: {
    //     delay: 350,
    //     url: '{{ route("customer.selectAjax") }}',
    //     dataType: 'json',

    //     results: function(data) {
    //         console.log(data)

    //         return {
    //             results: $.map(data, function(item) {

    //                 return {
    //                     text: item.code,
    //                 }
    //             })
    //         };
    //     }
    // },
    placeholder: 'Chọn khách hàng...',

});