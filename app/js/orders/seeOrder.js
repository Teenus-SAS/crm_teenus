$(document).ready(function() {
    id_order = sessionStorage.getItem('id_order')
    subtotal = 0

    $.get(`/api/order/${id_order}/0`,
        function(data, textStatus, jqXHR) {

            $('.to').html(`Contacto: ${data[0].contact}`);
            $('.company').html(data[0].company_name);
            $('.nit').html(`Nit: ${data[0].nit}`);
            $('.address').html(data[0].address);
            $('.email').html(data[0].email_customer);
            $('.email').html(`<a href="mailto:${data[0].email_customer}">${data[0].email_customer}</a>`);
            $('.order_id').html(`Pedido No. ${data[0].id_order}`);
            $('.quote_id').html(`Cotización No. ${data[0].id_quote}`);
            $('.dateCreation').html(`Fecha creación: ${data[0].date_register}`);
            $('.purchaseOrder').html(`Orden de Compra: ${data[0].purchase_order}`);
            $('.business').html(`Proyecto: ${data[0].name_business}`);

            $('.signtureSeller').prop('src', `${data[0].signature}`);
            $('.nameSeller').html(`${data[0].asesor}`);
            $('.cellphoneSeller').html(`${data[0].cellphone}`);
            $('.emailSeller').html(`${data[0].email}`);

            for (let i = 0; i < data.length; i++) {

                if (data[i].description_product == undefined)
                    data[i].description_product = ''

                $('tbody').append(`
                    <tr>
                        <td class="">${data[i].reference}</td>
                        <td class="text-center"><img src="${data[i].img}" alt="${data[i].product}" style="width: 60%;"></td>
                        <td class="text-left">
                            <h3><a href="javascript:;" style="color: #8DAC18;">${data[i].product}</a></h3>
                            <p>${data[i].description_product}</p>
                        </td>
                        <td class="text-center">${data[i].quantity}</td>
                        <td class="text-end">$${parseFloat((data[i].quantity * data[i].price) * (1 - (data[i].discount / 100)), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString()}</td>
                    </tr>`);
            }

            /* Datos comerciales */
            if (data[0].advance_date == '0000-00-00')
                data[0].advance_date = ''

            $('.advance_date').html(`<b>Fecha Anticipio:</b> ${data[0].advance_date}`);
            $('.advance_value').html(`<b>Valor Anticipo:</b> $${data[0].advance_value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString()}`);
            $('.policy').html(`<b>No. Póliza:</b> ${data[0].policy_number}`);

            /* Datos entrega */

            if (data[0].date_delivery == null)
                data[0].date_delivery = ''

            if (data[0].phone == null)
                data[0].phone = ''

            $('.date_delivery').html(`<b>Fecha:</b> ${data[0].date_delivery}`);
            $('.address_delivery').html(`<b>Dirección:</b> ${data[0].address_delivery}`);
            $('.contact_delivery').html(`<b>Contacto:</b> ${data[0].contact_delivery}`);
            $('.city_delivery').html(`<b>Ciudad:</b> ${data[0].city}`);
            $('.phone_delivery').html(`<b>Teléfono:</b> ${data[0].phone}`);

            seller = $('.user-name').html()
            position = $('.designattion').html()
            movil = $('.movil').html()
            $('#seller').html(`<b>${data[0].seller}</b>`);
            $('#position').html(`<b>${position}</b>`);
            $('#movil').html(movil);
        });


    $.get("/api/conditionsQuotes",
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