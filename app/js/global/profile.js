$(document).on('click', '.profile', function(e) {
    $('#modalModifyProfileUser').modal('show');
    $.get("../../../api/user",
        function(data, textStatus, jqXHR) {

            $('#names').val(data[0].firstname);
            $('#lastnames').val(data[0].lastname);
            $('#position').val(data[0].position);
            $('.email').val(data[0].email);
            $('#cellphone').val(data[0].cellphone);
            $('#photo').prop('src', data[0].avatar);
            $('#signature').prop('src', data[0].signature);
        },
    );
});


$('#btnUpdateUser').click(function(e) {
    e.preventDefault();

    let data = new FormData($('#formUpdateSeller')[0])

    $.ajax({
        type: "POST",
        url: "../../../api/updateUser",
        data: data,
        contentType: false,
        processData: false,

        success: function(data) {

            $('#modalModifyProfileUser').modal('hide')
            if (data.success == true)
                toastr.success(data.message)
            if (data.error == true)
                toastr.error(data.message)
        }
    });

});