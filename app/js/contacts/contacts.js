$('#btnCreateContact').click(function(e) {
    e.preventDefault()
    $('#id_contact').val('');
    $('#formNewContact')[0].reset()
    $('#titleNewContact').html('Nuevo Contacto')
    $('#btnSaveContact').html('Crear Contacto')
})

/* Actualizacion Usuario */

$(document).on('click', '.editContact', function(e) {
    e.preventDefault()
    let id = $(this).prop('id')
    let row = $(this).parent().parent()[0]
    let data = tableContacts.fnGetData(row)


    $('#btnSaveContact').html('Actualizar Contacto')
    $('#titleNewContact').html('Actualizar Contacto')

    $('#modalCreateContact').modal('show')
    $('#id_contact').val(id)
    $('.names').val(data.firstname)
    $('#lastname').val(data.lastname)
    $('#phone1').val(data.phone)
    $('#phone2').val(data.phone1)
    $('.email').val(data.email)
    $('.position').val(data.position)
    $(`#selectCompanies option[value='${data.id_company}'`).prop("selected", true);


})

/* Creacion Nuevo Usuario */

$('#btnSaveContact').click(function(e) {
    e.preventDefault();

    sessionStorage.removeItem('companies_contacts')
    let data = $('#formNewContact').serialize()

    $.ajax({
        type: 'POST',
        url: '../../../api/addContact',
        data: data,
        success: function(resp, jqXHR, statusCode) {
            if (resp.success == true) {
                $('#modalCreateContact').modal('hide')
                toastr.success(resp.message)
                $(':input', '#formNewContact').val('')
                updateTable()
            } else {
                toastr.error(resp.message)

            }
        }
    })
});

/* Eliminar Usuario */

$(document).on('click', '.eliminarContact', function(e) {
    e.preventDefault()
    let id = $(this).prop('id')

    alertify.confirm(
        'Proyecformas',
        `¿Realmente desea eliminar el contacto <b>${email}</b>?, esta acción no se puede reversar`,
        function() {
            $.ajax({
                type: 'POST',
                url: '../api/deleteUser',
                data: { idUser: id },
                success: function(r) {
                    if (r == null) toastr.success('Usuario no puede eliminarse', 'error')
                    else toastr.success('Usuario eliminado')
                    updateTable()
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
    $('#tableContacts').DataTable().clear()
    $('#tableContacts').DataTable().ajax.reload()
}