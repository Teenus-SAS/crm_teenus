/* Cargue tabla de usuarios */

tableUsers = $('#tableUsers').dataTable({
    pageLength: 10,

    ajax: {
        url: '../../../api/users',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'No.',
            "data": null,
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombres',
            data: 'firstname',
            className: 'uniqueClassName',
        },
        {
            title: 'Apellidos',
            data: 'lastname',
            className: 'uniqueClassName',
        },
        {
            title: 'Email',
            data: 'email',
            className: 'uniqueClassName',
        },
        {
            title: 'Rol',
            data: 'rol',
            className: 'uniqueClassName',
            render: (data, type, row) => {
                'use strict'
                return data == 1 ? 'Director' : data == '2' ? 'Asesor Comercial' : data == '3' ? 'Asistente Comercial' : 'Administrador'
            },
        },
        {
            title: 'Eliminar Pedidos',
            data: 'access_delete_order',
            className: 'uniqueClassName',
            render: (data, type, row) => {
                'use strict'
                return data == 1 ? 'Si' : 'No'
            },
        },
        {
            title: 'Avatar',
            data: 'avatar',
            className: 'uniqueClassName',
            render: (data, type, row) => {
                'use strict'
                return `<img src="${data}" alt="" style="width:40%;border-radius:100px">`
            },
        },
        {
            title: 'Estado',
            data: 'status',
            className: 'uniqueClassName',
            render: (data, type, row) => {
                'use strict'
                return data == 1 ? 'Activo' : 'Inactivo'
            },
        },
        {
            title: 'Acciones',
            data: 'id_user',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt editUser" data-toggle='tooltip' title='Editar Usuario' style="font-size: 35px;"></i></a>
                <a href="javascript:;" id="${data}" <i class="bx bx-user changeStateUsuario" data-toggle='tooltip' title='Activar/Inactivar Usuario' style="font-size: 35px;color:crimson"></i></a> `
            }
        },
    ],
})

/* Nuevo Usuario */

$('#btnNewUser').click(function(e) {
    e.preventDefault();
    $("#formNewSeller")[0].reset();
});

$('#createUser').click(function(e) {
    e.preventDefault();
    $("#btnCreateUser").html('Crear Usuario');
    $("#formNewSeller")[0].reset();
    $('.access option[value="0"]').attr("selected", true);
    $(".access").hide();

});


/* Creacion Nuevo Usuario */
$(document).ready(function() {
    $('#btnCreateUser').click(function(e) {
        e.preventDefault()
        let data = $('#formNewSeller').serialize()

        userName = $('#userName').val();
        userLastnames = $('#userLastnames').val();
        position = $('#position').val();
        rol = $('#rol').val();
        userEmail = $('#userEmail').val();
        password = $('#password').val();

        if (userName == "" || userLastnames == "" || position == "" || rol == "" || userEmail == "") {
            toastr.error('Ingrese todos los datos')
            return false
        }

        $.ajax({
            type: 'POST',
            url: '../api/addUser',
            data: data,
            success: function(response, jqXHR, statusCode) {
                if (response.success == true) {
                    $('#modalCreateSeller').modal('hide')
                    toastr.success(response.message)
                    updateTable()
                }

                if (response.info == true)
                    toastr.info(response.message)

                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Usuario */

    $(document).on('click', '.editUser', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableUsers.fnGetData(row)

        $('#modalCreateSeller').modal('show')

        $('#titleNewUser').val('Actualizar Usuario')

        $('#id_user').val(id)
        $('#userName').val(data.firstname)
        $('#userLastnames').val(data.lastname)
        $('#userPosition').val(data.position)

        $(`#rol option[value=${data.rol}]`).prop("selected", true);

        if (data.rol == 1) {
            $('.access').show(100);
            $(`#accessDeletePedidos option[value=${data.access_delete_order}]`).prop("selected", true);
        } else {
            $('.access').hide(100);
            $(`#accessDeletePedidos option[value=${data.access_delete_order}]`).prop("selected", true);
        }

        $('#userEmail').val(data.email)
        $('#btnCreateUser').html('Actualizar Usuario')
    })

    /* Eliminar Usuario */

    $(document).on('click', '.deleteUser', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableUsers.fnGetData(row)

        alertify
            .confirm(
                'Eliminar Usuario',
                `¿Realmente desea < b style = "color:red" > eliminar</ > el usuario < b style = "color:red" > ${data.firstname} ${data.lastname}</ >?, esta acción es permanente`,
                function() {
                    $.ajax({
                        type: 'POST',
                        url: '../api/deleteUser',
                        data: { idUser: id },
                        success: function(r) {
                            $('#modalCreateUser').modal('hide')
                            updateTable()
                            if (response.success == true)
                                toastr.success(response.message)
                            if (response.error == true)
                                toastr.success(response.message)
                        },
                    })
                },
                function() {
                    toastr.success('Cancelado', 'error')
                },
            ).set('labels', { ok: 'Si', cancel: 'No' })
    })

    /* Inactivar/Activar usuario */

    $(document).on('click', '.changeStateUsuario', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')

        $.ajax({
            url: `../../../api/inactivateActivateUser/${id} `,
            success: function(response) {
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.info == true)
                    toastr.info(response.message)
                if (response.error == true)
                    toastr.success(response.message)
            },
        })
    })

    /* Actualizar tabla */

    function updateTable() {
        $('#tableUsers').DataTable().clear()
        $('#tableUsers').DataTable().ajax.reload()
    }
})