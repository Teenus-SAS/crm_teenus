$('#salesPhases').toggle();

$('#btnSalesPhase').click(function(e) {
    e.preventDefault();
    $('#btnSalesPhase').val('');
    $('#salesPhases').toggle(500);
    $('#btnCreateSalePhase').html('Crear Fase de Venta');
});

/* Cargue tabla Fases de Venta */

tableSalesPhases = $('#tableSalesPhases').dataTable({
    pageLength: 25,
    ajax: {
        url: '/api/salesPhases',
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
            title: 'Fase de Venta',
            data: 'sales_phase',
            className: 'uniqueClassName',
        },
        {
            title: 'Oportunidad',
            data: 'percent',
            className: 'uniqueClassName',

            render: (data, type, row) => {
                return `${(data * 100).toFixed(0).replace('.', ',')}%`
            },
        },
        {
            title: 'Acciones',
            data: 'id_phase',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateSalePhase" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteSalePhase" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>`
            }
        },
    ],
})

/* Creacion Nueva Fase de Venta */

$(document).ready(function() {
    $('#btnCreateSalePhase').click(function (e) {
        e.preventDefault()

        let salePhase = $('#salePhase').val();
        let oportunity = $('#oportunity').val();

        if (!salePhase || salePhase == '' || !oportunity || oportunity == '') {
            toastr.error('Ingrese la nueva Fase de Venta')
            return false;
        }

        let data = $('#frmSalesPhases').serialize();

        $.ajax({
            method: 'POST',
            url: `/api/addSalePhase`,
            data: data,
            success: function (response, jqXHR, statusCode) {
                $('#salesPhases').hide(500);
                $('#id_salePhase').val('')
                $('#salePhase').val('')
                $('#oportunity').val('')

                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    });

    /* Actualizacion Fase de Venta */

    $(document).on('click', '.updateSalePhase', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableSalesPhases.fnGetData(row)

        percent = (data.percent * 100).toFixed(2)
        $('#salesPhases').show(500)
        $('#id_salePhase').val(data.id_phase)
        $('#salePhase').val(data.sales_phase)
        $('#oportunity').val(percent)

        $('#btnCreateSalePhase').html('Actualizar Fase de Venta')
    })

    /* Eliminar Fase de Venta */

    $(document).on('click', '.deleteSalePhase', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableSalesPhases.fnGetData(row)

        alertify.confirm(
            'teenus',
            `¿Realmente desea <b style="color:red">eliminar</b> la fase de venta: <b style="color:red">${data.sales_phase}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `/api/deleteSalePhase/${id}`,
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
        ).set('labels', { ok: 'Si', cancel: 'No' });
    })

    /* Actualizar tabla */

    function updateTable() {
        $('#tableSalesPhases').DataTable().clear()
        $('#tableSalesPhases').DataTable().ajax.reload()
    }
})