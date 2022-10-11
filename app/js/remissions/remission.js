/* Ver Remisión */

$(document).on('click', '.seeRemission', function(e) {
    e.preventDefault();

    let id_remission = $(this).prop('id')
    let id_order = $(this).parent().parent().children().eq(2).text();
    sessionStorage.setItem('id_order', id_order)
    sessionStorage.setItem('id_remission', id_remission)
});


/* Generar remision */

$(document).on('click', '.generateRemission', function(e) {
    e.preventDefault();

    let id = $(this).prop('id')
    sessionStorage.setItem('id_remission', id)
    $('#modalCreateRemission').modal('show');

    $('#referencia option[value="0"]').prop("selected", true);
    $('#producto option[value="0"]').prop("selected", true);
    $('#cantidad').val('');

    /* Cargar referencia y producto */

    $.get(`/api/loadProductsRemission/${id}`,
        function(data, textStatus, jqXHR) {

            productsRemission = JSON.stringify(data)
            sessionStorage.setItem('productsRemission', productsRemission)
            id = sessionStorage.getItem('id_remission')
            $('#id_remission').val(id);

            let $selectRef = $(`#reference`)
            $selectRef.empty()
            let $selectProd = $(`#product`)
            $selectProd.empty()

            $selectRef.append(`<option option disabled selected> Seleccionar</option> `)
            $selectProd.append(`<option option disabled selected> Seleccionar</option> `)

            for (let i = 0; i < data.length; i++) {
                $selectRef.append(`<option option value = ${data[i].id_quote_product}> ${data[i].reference} </option> `)
                $selectProd.append(`<option option value = ${data[i].id_quote_product}> ${data[i].product} </option> `)
            }
        },
    );
});

/* Seleccionar referencia o producto */

$('#reference').change(function(e) {
    e.preventDefault();

    id = this.value
    data = JSON.parse(sessionStorage.getItem('productsRemission'))
    $(`#product option[value=${id}]`).prop("selected", true);
    $('.quantity').val(data[0].quantity).prop('disabled', true);
});

$('#product').change(function(e) {
    e.preventDefault();

    id = this.value
    data = JSON.parse(sessionStorage.getItem('productsRemission'))
    $(`#reference option[value=${id}]`).prop("selected", true);
    $('#quantity').val(data[0].quantity).prop('disabled', true);
});

/* Oculta condiciones comerciales */

$('.condicionesComerciales').hide();
$('#btnSaveOrder').html('Actualizar');

/* Modificar datos de entrega remision */

$(document).on('click', '.modifyDataDeliveryRemission', function(e) {
    e.preventDefault();
    let id_order = $(this).prop('id')
    let id_remission = $(this).parent().parent().children().eq(3).text();

    $('#date_delivery').val('');
    $('#contact_delivery').val('');
    $('#address_delivery').val('');
    $('#phone').val('');
    $('#city').val('');
    $('#observation').val('');

    LoadDataDelivery(id_order, id_remission)
});


/* Almacenar y actualizar datos de Entrega */

$('#btnSaveOrder').click(function(e) {
    e.preventDefault();

    id_order = sessionStorage.getItem('id_order')
    id_remission = sessionStorage.getItem('id_remission')

    data = $('#formNewOrder').serialize() + '&' + `id_order=${id_order}` + '&' + `id_remission=${id_remission}`
    ModifyDataDelivery(data)

});