/* Actualizacion datos de entrega */

$(document).ready(function() {

    LoadDataDelivery = (id_order, id_remission) => {
        sessionStorage.setItem('id_order', id_order)
        sessionStorage.setItem('id_remission', id_remission)

        $.get(`../../../api/order/${id_order}/${id_remission}`,
            function(data, textStatus, jqXHR) {

                $('#modalDataOrder').modal('show')

                if (data.length == 0)
                    return false

                $('#btnSaveOrder').html('Actualizar');

                $('#purchase_order').val(data[0].purchase_order);
                $('#advance_date').val(data[0].advance_date);
                $('#advance_value').val(data[0].advance_value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString());
                $('#policy').val(data[0].policy_number);

                $('#date_delivery').val(data[0].date_delivery);
                $('#contact_delivery').val(data[0].contact_delivery);
                $('#address_delivery').val(data[0].address_delivery);
                $('#phone').val(data[0].phone);
                $('#city').val(data[0].city);
                $('#observation').val(data[0].observation);
            },
        );
    }



    ModifyDataDelivery = (data) => {

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
    }

});