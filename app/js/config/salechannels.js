$('#salesChannels').hide();

$('#btnSaleChannel').click(function(e) {
    e.preventDefault();
    $('#id_saleChannel').val('');
    $('#saleChannel').val('');
    $('#salesChannels').toggle(500);
});

/* Cargue tabla de Canal de Ventas */

tableSalesChannels = $('#tableSalesChannels').dataTable({
    pageLength: 10,
    ajax: {
        url: '/api/salesChannels',
        dataSrc: '',
    },
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
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
            title: 'Canal de Venta',
            data: 'sales_channels',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_sales_channels',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateSaleChannel" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteSaleChannel" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>`
            }
        },
    ],
})

/* Creacion Nuevo Canal de Ventas */

$(document).ready(function() {
    $('#btnCreateSaleChannel').click(function(e) {
        e.preventDefault()
        let data = $('#frmSaleChannels').serialize();

        if (data == undefined || data == '') {
            toastr.error('Ingrese el nuevo Canal de Venta')
            return false;
        }

        $.ajax({
            method: 'POST',
            url: `/api/addSaleChannel`,
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#salesChannels').hide(500)
                $('#id_saleChannel').val('');
                $('#saleChannel').val('');

                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Canal de Ventas */

    $(document).on('click', '.updateSaleChannel', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableSalesChannels.DataTable().row(row).data();

        $('#salesChannels').show(500)
        $('#id_saleChannel').val(data.id_sales_channels)
        $('#saleChannel').val(data.sales_channels)

        $('#btnCreateSaleChannel').html('Actualizar Canal de Ventas')
    })

    /* Eliminar Canal de Ventas */

    $(document).on('click', '.deleteSaleChannel', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableSalesChannels.DataTable().row(row).data();

        alertify.confirm(
            'teenus',
            `¿Realmente desea <b style="color:red">eliminar</b> el canal de ventas: <b style="color:red">${data.sales_channels}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `/api/deleteSaleChannel/${id}`,
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
        $('#tableSalesChannels').DataTable().clear()
        $('#tableSalesChannels').DataTable().ajax.reload()
    }
})