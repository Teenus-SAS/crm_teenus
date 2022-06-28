$(document).ready(function() {
    $('#btnLogin').on('click', function(e) {
        let data = $('#autentication').serialize()
        $.ajax({
            type: 'POST',
            url: '/api/user',
            data: data,
            success: function(data, textStatus, xhr) {

                if (data.error == true) {
                    toastr.error(data.message)
                    return false
                } else if (data.success == true)
                    location.href = 'app'
                else {
                    toastr.error('Ocurrio un error durante la conexión, Intente nuevamente')
                    return false
                }
            },
        })
    })
})