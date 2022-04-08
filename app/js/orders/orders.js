/* Modificar datos de Entrega */

$(document).on('click', '.modifyDataDeliveryOrder', function(e) {
    e.preventDefault();
    let id_order = $(this).prop('id')
    LoadDataDelivery(id_order, 0)
});


/* Actualizar datos de entrega para el pedido */

$('#btnSaveOrder').click(function(e) {
    e.preventDefault();

    id = sessionStorage.getItem('id_order')
    data = $('#formNewOrder').serialize() + `&id=${id}`

    fecha = $('#date_delivery').val();
    valor = validationDate(fecha);

    if (valor === 0) {
        toastr.error('La fecha de Entrega debe ser mayor al día de hoy')
        return false
    }

    $.post(`../../../api/modifyDataDeliveryOrder`, data,
        function(data, textStatus, jqXHR) {
            if (data.success) {
                toastr.success(data.message)
                $('#modalDataOrder').modal('hide')
            }
            if (data.error)
                toastr.info(data.message)
        },
    );
});

/* Cancelar Pedido */

$(document).on('click', '.cancelOrder', function(e) {
    e.preventDefault();

    let row = $(this).parent().parent()[0]
    let data = tableOrders.fnGetData(row)

    alertify.confirm('Proyecformas', `¿Realmente desea <b>anular el pedido No. ${data.id_order}</b>?`, function() {
        alertify.prompt('Proyecformas', 'Motivo de Anulación', '', function(evt, value) {

            $.ajax({
                type: "POST",
                url: "../../../api/cancelOrder",
                data: { id: data.id_order, observation: value },

                success: function(data) {
                    updateTable();
                    if (data.success)
                        toastr.success(data.message)
                    if (data.error)
                        toastr.error(data.message)
                }
            });

        }, function() { toastr.info('Anulación de Pedido sin observaciones') }).set('labels', { ok: 'Aceptar', cancel: 'Cancelar' });
    }, function() { toastr.info('Acción cancelada') }).set('labels', { ok: 'Si', cancel: 'No' });
});

/* Ver Pedido */

$(document).on('click', '.seeOrder', function(e) {
    e.preventDefault();
    let id = $(this).prop('id')
    sessionStorage.setItem('id_order', id)
});

/* Actualizar tabla */

function updateTable() {
    $('#tableOrders').DataTable().clear()
    $('#tableOrders').DataTable().ajax.reload()
}