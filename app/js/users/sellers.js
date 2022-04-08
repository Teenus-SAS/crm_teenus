/* Cargue tabla de Asesores Comerciales */
$(document).ready(function() {

    let id_seller_old

    tableSellers = $('#tableSellers').dataTable({
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
                <a href="javascript:;" id="${data}" <i class="bx bx-user changeStateUsuario" data-toggle='tooltip' title='Activar/Inactivar Usuario' style="font-size: 35px;color:lightgray"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt editUser" data-toggle='tooltip' title='Editar Usuario' style="font-size: 35px;"></i></a>
                <a href="javascript:;" id="${data}" <i class="bx bx-transfer reassignCompanies" data-toggle='tooltip' title='Reasignar Empresa a Nuevo Comercial' style="font-size: 35px;"></i></a> 
                `
                }
            },
        ],
    })


    /* Limpiar formulario y id usuario */

    $('.btnCreateSeller').click(function(e) {
        e.preventDefault();
        $("#formNewSeller")[0].reset();
        $('.id_user').val('');
    });

    /* Creacion Nuevo Usuario */

    $('#btnCreateUser').click(function(e) {
        e.preventDefault()
        let data = $('#formNewSeller').serialize();

        $.ajax({
            type: 'POST',
            url: '../api/addUser',
            data: data,

            success: function(data, textStatus, xhr) {
                if (data.success == true) {
                    $('#modalCreateSeller').modal('hide')
                    $("#formNewSeller")[0].reset();
                    toastr.success(data.message)
                    updateTable()
                }
                if (data.error == true)
                    toastr.success(data.message)

            },
        })
    })

    /* Actualizacion Usuario */

    $(document).on('click', '.editUser', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableSellers.fnGetData(row)

        $('#modalCreateSeller').modal('show')
        $('#titleNewUser').val('Actualizar Usuario')

        $('#id_user').val(id)
        $('#userName').val(data.firstname)
        $('#userLastnames').val(data.lastname)
        $('#userPosition').val(data.position)
        $('#userEmail').val(data.email)

        $('#btnCreateUser').html('Actualizar Usuario')
    })


    /* Inactivar/Activar usuario */

    $(document).on('click', '.changeStateUsuario', function(e) {
        e.preventDefault()
        id = this.id

        $.ajax({
            type: 'GET',
            url: `../../../api/inactivateActivateUser/${id}`,
            data: { idUser: id },
            success: function(r) {

                if (r.success)
                    toastr.success(r.message)
                else if (r.info)
                    toastr.info(r.message)
                updateTable()
            },
        })

    })

    /* Reasignar empresas */

    $(document).on('click', '.reassignCompanies', function(e) {
        e.preventDefault()
        id_seller_old = this.id
        $('#titleReasignCompanies').hide();
        $('#modalReassignSeller').modal('show')


    })

    $('.reassignSeller').click(function(e) {
        e.preventDefault();

        id_seller = $('.selectSeller').val();

        alertify.confirm('Empresas', '¿Está seguro de reasignar las empresas?, esta acción no se puede reversar',
            function() {
                $.ajax({
                    url: `../../../api/reassignCompanies/${id_seller}/${id_seller_old}`,
                    success: function(r) {
                        if (r.success)
                            toastr.success(r.message)
                        else if (r.info)
                            toastr.info(r.message)

                        $('#modalReassignSeller').modal('hide')
                        $(".selectSeller option:contains(Seleccionar...)").prop('selected', true);
                    },
                })
            },
            function() {
                alertify.error('Cancelado')
            });



    });


    /* Actualizar tabla */

    function updateTable() {
        $('#tableSellers').DataTable().clear()
        $('#tableSellers').DataTable().ajax.reload()
    }
})