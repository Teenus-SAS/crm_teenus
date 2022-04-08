$(document).ready(function() {

    let id_order = sessionStorage.getItem('id_order')
    let id_remission = sessionStorage.getItem('id_remission')

    info = 0;
    $.get(`../../../api/remission/${id_order}/${id_remission}`,
        function(data, textStatus, jqXHR) {
            info = data;

            $('.to').html(`Contacto: ${data[1].contact}`);
            $('.company').html(data[1].company_name);
            $('.nit').html(`Nit: ${data[1].nit}`);
            $('.address').html(data[1].address);
            $('.email').html(data[1].email_customer);
            $('.email').html(`<a href="mailto:${data[1].email_customer}">${data[1].email_customer}</a>`);
            $('.remission_id').html(`Remisión No. ${data[1].id_remission}`);
            $('.order_id').html(`Pedido No. ${data[1].id_order}`);
            $('.dateCreation').html(`Fecha creación: ${data[1].date_register}`);
            $('.purchaseOrder').html(`Orden de Compra: ${data[1].purchase_order}`);

            $('.business').html(`Proyecto: ${data[1].name_business}`);

            $('.signtureAux').prop('src', `${data[0].signature}`);
            $('.nameAux').html(`${data[0].firstname} ${data[0].lastname}`);
            $('.positionAux').html(`${data[0].position}`);
            $('.cellphoneAux').html(`${data[0].cellphone}`);
            $('.emailAux').html(`${data[0].email}`);

            for (let i = 3; i < data.length; i++) {
                data[i].description_product == undefined ? data[i].description_product = '' : data[i].description_product

                $('tbody').append(`
                        <tr>
                            <td class="">${data[i].reference}</td>
                            <td class="text-left">
                                <h3><a href="javascript:;" style="color: #8DAC18;">${data[i].product}</a></h3>
                                <p>${data[i].description_product}</p>
                            </td>
                        <td class="text-center">${data[i].quantity_delivered}</td>
                    </tr>`);
            }

            /* <td class="text-center"><img src="${data[i].img}" alt="${data[i].product}" style="width: 20%;"></td> */

            data[2].date_delivery == null ? data[2].date_delivery = '' : data[2].date_delivery
            data[2].phone == null ? data[2].phone = '' : data[2].phone

            $('.date_delivery').html(`<b>Fecha:</b> ${data[2].date_delivery}`);
            $('.address_delivery').html(`<b>Dirección:</b> ${data[2].address_delivery}`);
            $('.contact_delivery').html(`<b>Contacto:</b> ${data[2].contact_delivery}`);
            $('.city_delivery').html(`<b>Ciudad:</b> ${data[2].city}`);
            $('.phone_delivery').html(`<b>Teléfono:</b> ${data[2].phone}`);
        });

    $.get("../../../api/conditionsQuotes",
        function(data, textStatus, jqXHR) {
            $('.payment_conditions').html(`Condición de Pago: ${data.payment_condition}`);
            $('.validity').html(`Validez de la Oferta: ${data.validity}`);
            $('.guarantee').html(`Garantia del producto: ${data.guarantee}`);
        },
    );





});

function printDiv(nombreDiv) {
    var contenido = document.getElementById(nombreDiv).innerHTML;
    var contenidoOriginal = document.body.innerHTML;

    document.body.innerHTML = contenido;

    window.print();

    document.body.innerHTML = contenidoOriginal;
}

/* Bloquear ctrl+p */
/* var isCtrl = false;
document.onkeyup = function(e) {
    if (e.which == 27) isCtrl = false;
}
document.onkeydown = function(e) {
    if (e.which == 17) isCtrl = true;
    if (e.which == 80 && isCtrl == true) {
        //Combinancion de teclas CTRL+P y bloquear su ejecucion en el navegador
        return false;
    }
} */