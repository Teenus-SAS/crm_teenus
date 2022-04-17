/* Cargue tabla de usuarios */

$('#paymentMethods').toggle();

$('#btnPaymentMethod').click(function(e) {
    e.preventDefault();
    $('#id_paymentMethod').val('')
    $('#btnCreatePaymentMethod').html('Crear Método de Pago')
    $('#paymentMethods').toggle(500);
});

tablePaymentMethods = $('#tablePaymentMethods').dataTable({
    pageLength: 10,

    ajax: {
        url: '../../../api/paymentMethods',
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
            title: 'Condición de Pago',
            data: 'method',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_method',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateMethod" data-toggle='tooltip' title='Editar Condición de pago' style="font-size: 35px;"></i></a>
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteMethod" data-toggle='tooltip' title='Eliminar Condición de pago' style="font-size: 35px;color:red;"></i></a>`
            }
        },
    ],
})

/* Creacion Nuevo Usuario */
$(document).ready(function() {

    $('#btnCreatePaymentMethod').click(function(e) {

        e.preventDefault()
        let data = $('#frmPaymentMethod').serialize();

        if (data == undefined || data == '') {
            toastr.error('Ingrese la nueva forma de pago')
            return false;
        }

        $.ajax({
            method: 'POST',
            url: `../api/addPaymentMethod`,
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#paymentMethods').hide(500)
                $('#paymentMethod').val('')
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Metodo de Pago */

    $(document).on('click', '.updateMethod', function(e) {
        e.preventDefault()

        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tablePaymentMethods.fnGetData(row)

        $('#paymentMethods').show(500)
        $('#id_paymentMethod').val(data.id_method)
        $('#paymentMethod').val(data.method)

        $('#btnCreatePaymentMethod').html('Actualizar Método de Pago')
    })

    /* Eliminar Metodo de Pago */

    $(document).on('click', '.deleteMethod', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tablePaymentMethods.fnGetData(row)

        alertify.confirm(
            'teenus',
            `¿Realmente desea <b style="color:red">Eliminar</b> el Método de Pago: <b style="color:red">${data.method}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `../api/deletePaymentMethod/${data.id_method}`,
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
        $('#tablePaymentMethods').DataTable().clear()
        $('#tablePaymentMethods').DataTable().ajax.reload()
    }
})