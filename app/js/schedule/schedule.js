$(document).ready(function() {

    $('#btnModalTask').click(function(e) {
        e.preventDefault();
        $('#id_schedule').val('');
        $('#titleNewSchedule').html('Crear Nueva Actividad');
        $('#btnCreateTask').html('Crear Actividad');
        $("#formNewTask")[0].reset();
    });


    /* Save Task */

    $('#btnCreateTask').click(function(e) {
        e.preventDefault();

        let data = $('#formNewTask').serialize()

        fecha = $('#fechaAccion').val();
        valor = validationDate(fecha);

        if (valor === 0) {
            toastr.error('La fecha de Acción Comercial debe ser mayor al día de hoy')
            return false
        }

        $.ajax({
            type: 'POST',
            url: '/api/addSchedule',
            data: data,
            success: function(response, jqXHR, statusCode) {

                if (response.success) {
                    $('#modalCreateTask').modal('hide')
                    $("#formNewTask")[0].reset();
                    toastr.success(response.message)
                    updateTable()
                } else if (response.error)
                    toastr.error(response.message)
            },
        })
    });

    /* End Task */

    $(document).on('click', '.endSchedule', function(e) {
        e.preventDefault();
        let id = $(this).prop('id')
        $.ajax({
            type: "POST",
            url: "/api/deleteSchedule",
            data: { idTask: id },
            success: function(response) {
                updateTable()
                if (response.success)
                    toastr.success(response.message)
                if (response.error)
                    toastr.error(response.message)
            }
        });

    });

    /* update */

    $(document).on('click', '.updateSchedule', function(e) {
        e.preventDefault();
        /* $("#formNewTask")[0].reset(); */

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]

        data = tableSchedule.DataTable().row(row).data();

        if (data == null)
            data = tableAlertTask.DataTable().row(row).data();
        else if (data == null)
            data = tableDelayTask.DataTable().row(row).data();
        else if (data == null)
            data = tableCompletedTask.DataTable().row(row).data();

        $('#modalCreateTask').modal('show')
        $('#id_schedule').val(id);
        $(`#selectContactForms option:contains(${data.contact_form})`).prop('selected', true);
        $(`#selectCompanies option:contains(${data.company_name})`).prop('selected', true)

        contacts(data.company_name, data.contact)

        $('#fechaAccion').val(data.due_date)
        $('#descriptionAction').val(data.description)

        $('#titleNewSchedule').html('Actividad');
        $('#btnCreateTask').html('Actualizar Actividad');

    });


    /* Active Task */

    $(document).on('click', '.undoEndSchedule', function(e) {
        e.preventDefault();
        let id = $(this).prop('id')
        $.ajax({
            type: "POST",
            url: "/api/activateSchedule",
            data: { idTask: id },
            success: function(response) {
                updateTable()
                if (response.success)
                    toastr.success(response.message)
                if (response.error)
                    toastr.error(response.message)
            }
        });

    });
});

/* Actualizar tabla */

function updateTable() {
    $('#tableSchedule').DataTable().clear()
    $('#tableSchedule').DataTable().ajax.reload()

    $('#tableAlertTask').DataTable().clear()
    $('#tableAlertTask').DataTable().ajax.reload()

    $('#tableDelayTask').DataTable().clear()
    $('#tableDelayTask').DataTable().ajax.reload()

    $('#tableCompletedTask').DataTable().clear()
    $('#tableCompletedTask').DataTable().ajax.reload()
}