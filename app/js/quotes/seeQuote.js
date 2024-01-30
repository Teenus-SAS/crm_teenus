$(document).ready(function() {
    id = sessionStorage.getItem('id_quote')
    subtotal = 0

    $.get(`/api/updateQuotes/${id}`,
        function(data, textStatus, jqXHR) {

            $('.to').html(`Contacto: ${data[0].contact}`);
            $('.company').html(data[0].company_name);
            $('.nit').html(`Nit: ${data[0].nit}`);
            $('.address').html(data[0].address);
            $('.email').html(`Email: ${data[0].email_customer}`);
            $('.email').html(`<a href="mailto:${data[0].email_customer}">Email: ${data[0].email_customer}</a>`);
            $('.quote_id').html(`COTIZACIÓN No. ${data[0].id_quote}`);
            $('.dateCreation').html(`Fecha creación: ${data[0].date_register}`);
            $('.business').html(`Proyecto: ${data[0].name_business}`);
            /* newdate = data[0].created_at.setDate(data[0].created_at.getDate() + 30);
            $('.dateExpiration').html(`Fecha vencimiento: ${newdate}`); */

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
                        <td class="text-end">$${parseFloat(data[i].price, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString()}</td>
                        <td class="text-end">${parseFloat(data[i].discount)}%</td>
                        <td class="text-end">$${parseFloat((data[i].quantity * data[i].price) * (1 - (data[i].discount / 100)), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString()}</td>
                    </tr>`);
                subtotalPrice = data[i].quantity * data[i].price * (1 - (data[i].discount / 100))
                subtotal = subtotal + subtotalPrice
            }

            $("#subtotal").text('$' + parseFloat(subtotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString());
            $("#iva").text('$' + parseFloat(subtotal * (19 / 100), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString());
            $("#total").text('$' + parseFloat(subtotal * (1 + (19 / 100)), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString());

            $('.signature').prop('src', `${data[0].signature}`);
            $('#nameSeller').html(`<b>${data[0].seller}</b>`);
            $('#positionSeller').html(`<b>${data[0].position}</b>`);
            $('#emailSeller').html(`<b>${data[0].emailSeller}</b>`);
            $('#cellphoneSeller').html(data[0].cellphone);

            $('.payment_conditions').html(`Condición de Pago: ${data[0].method}`);
            $('.validity').html(`Validez de la Oferta: ${data[0].validity}`);
            $('.guarantee').html(`Garantia del producto: ${data[0].guarantee}`);
            $('.delivery_date').html(`Fecha de Entrega: ${data[0].delivery_date}`);
        });
});

/* $('#btnImprimirQuote').click(function(e) {
    e.preventDefault();

    let printContents = document.getElementById('invoice').innerHTML;
    w = window.open();
    w.document.write(printContents);
    w.document.close(); // necessary for IE >= 10
    w.focus(); // necessary for IE >= 10
    w.print();
    w.close();
    return true;

}); */