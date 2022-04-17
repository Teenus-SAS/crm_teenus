$('#contactForms').toggle();

$('#btnContactForm').click(function(e) {
    e.preventDefault();
    $('#id_contactForm').val();
    $('#contactForm').val();
    $('#contactForms').toggle(500);

});

/* Cargue tabla de Forma de Contactos */

tableContactForm = $('#tableContactForm').dataTable({
    pageLength: 10,

    ajax: {
        url: '../../../api/contactForms',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
        },
        {
            title: 'Formas de Contacto',
            data: 'contact_form',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_contact_form',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateContactForm" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteContactForm" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>
                `
            }
        },
    ],
})

/* Creacion Nuevo Forma de Contacto */
$(document).ready(function() {
    $('#btnCreateContactForm').click(function(e) {
        e.preventDefault()

        let data = $('#frmContactForms').serialize()

        if (data == undefined || data == '') {
            toastr.error('Ingrese la nueva forma de contacto')
            return false;
        }

        $.ajax({
            method: 'POST',
            url: `../api/addContactForms`,
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#contactForms').hide(500)
                $('#contactForm').val('')
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.success(response.message)
            },
        })
    })

    /* Actualizacion Forma de Contacto */

    $(document).on('click', '.updateContactForm', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableContactForm.fnGetData(row)

        $('#contactForms').show(500)
        $('#id_contactForm').val(data.id_contact_form)
        $('#contactForm').val(data.contact_form)

        $('#btnCreateContactForm').html('Actualizar Forma de Contacto')
    })

    /* Eliminar Forma de Contacto */

    $(document).on('click', '.deleteContactForm', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableContactForm.fnGetData(row)

        alertify.confirm(
            'teenus',
            `¿Realmente desea <b style="color:red">eliminar</b> la Forma de Contacto <b style="color:red">${data.contact_form}</b>?, esta acción no se puede reversar`,
            function() {
                $.ajax({
                    type: 'POST',
                    url: `../api/deleteContactForm/${id}`,
                    success: function(response) {
                        updateTable()
                        if (response.success == true)
                            toastr.success(response.message)
                        if (response.error == true)
                            toastr.error(response.message)
                    },
                })
            },
            function() {
                alertify.error('Cancel')
            },
        )
    })

    /* Actualizar tabla */

    function updateTable() {
        $('#tableContactForm').DataTable().clear()
        $('#tableContactForm').DataTable().ajax.reload()
    }
})