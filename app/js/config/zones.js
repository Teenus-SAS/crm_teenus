/* Cargue tabla de Zonas */

tableZones = $('#tableZones').dataTable({
    pageLength: 10,
    ajax: {
        url: '/api/zones',
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
            title: 'Zonas',
            data: 'zone',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_zone',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateZone" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteZone" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>`
            }
        },
    ],
})

/* Creation New Zone */
$(document).ready(function() {

    $('#btnCreateZone').click(function(e) {
        e.preventDefault()
        let data = $('#zone').val()

        if (data == undefined || data == '') {
            toastr.error('Ingrese la nueva zona')
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '/api/addZones',
            data: { zone: data },

            success: function(response, jqXHR, statusCode) {
                $('#zones').toggle(1000)
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == 2)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Zona */

    $(document).on('click', '.updateZone', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableZones.fnGetData(row)

        $('#zones').show(500)
        $('#inZone').val(data.id_zone);
        $('#zone').val(data.zone);
        $('#btnCreateZone').html('Actualizar Zona');


    })

    /* Eliminar Zona */

    $(document).on('click', '.deleteZone', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableZones.fnGetData(row)

        alertify.confirm(
            'teenus',
            `¿Realmente desea <b style="color:red">Eliminar</b> la Zona <b style="color:red">${data.zone}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `/api/deleteZones/${id}`,
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
                toastr.error('Acción cancelada')
            },
        ).set('labels', { ok: 'Si', cancel: 'No' })
    })

    /* update table */

    function updateTable() {
        $('#tableZones').DataTable().clear()
        $('#tableZones').DataTable().ajax.reload()
    }

    /* load inputs new zone */

    $('#zones').toggle();

    $('#btnNewZone').click(function(e) {
        e.preventDefault();
        $('#inZone').val('');
        $('#zone').val('');

        $('#zones').toggle(500);
        $('#btnCreateZone').html('Crear Zona');
    });

})