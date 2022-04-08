/* Cargar datos de remision */

var info
products = []
$('#quantityDeliver').prop('disabled', true);
$('#quantityDelivered').prop('disabled', true);
$('#quantity').prop('disabled', true);
$('#quantity').val('');

/* Crear Remision */

$(document).on('click', '.createRemission', function(e) {
    e.preventDefault();

    let id_order = $(this).prop('id')
    sessionStorage.setItem('id_order', id_order)

    $("#tableProductsRemission > tbody").empty();
    $('#quantity').val('');
    $('#quantityDeliver').val('');
    $('#quantityDelivered').val('');

    $('#modalCreateRemission').modal('show');

    /* Cargar datos de remision */

    $.get(`../../../api/order/${id_order}/0`, function(data, textStatus, jqXHR) {
        loadReferences(data)
    });

});


/* Cargar referencias y productos en la remision */

loadReferences = (data) => {
    info = data

    $select = $(`#reference`)
    $select.empty()
    $select.append(`<option disabled selected>Seleccionar</option>`)
    for (let i = 0; i < data.length; i++) {
        $select.append(
            `<option value = ${data[i].id_quote_product}> ${data[i].reference}</option > `,
        )

    }

    $select = $(`#product`)
    $select.empty()
    $select.append(`<option disabled selected>Seleccionar</option>`)
    for (let i = 0; i < data.length; i++) {
        $select.append(
            `<option value = ${data[i].id_quote_product}> ${data[i].product}</option > `,
        )

    }
}


/* Seleccion de producto para remision */

$('#reference').change(function(e) {
    value = this.value
    loadquantityproductsremission(value)
})

$('#product').change(function(e) {
    value = this.value
    loadquantityproductsremission(value)
})


/* Adicionar productos a remision */

$('#btnAddProductRemission').click(function(e) {
    e.preventDefault();

    let quantity = parseInt($('#quantity').val());
    let quantityDelivered = parseInt($('#quantityDelivered').val());
    let quantityDeliver = parseInt($('#quantityDeliver').val());
    let id_reference = $('#reference').val();

    isNaN(quantityDeliver) ? quantityDeliver = 0 : quantityDeliver

    if (quantityDeliver == 0) {
        toastr.error('La cantidad para Entregar no puede ser cero(0). Ingrese un valor valido')
        return false
    }

    if (quantity < quantityDeliver + quantityDelivered) {
        toastr.error('La cantidad para Entregar no puede ser mayor a la cantidad Fabricada')
        return false
    }

    /* valida las cantidades ingresadas no sean superadas  */

    quantityProduct = 0;
    for (let i = 0; i < products.length; i++) {
        if (products[i].id_quote_product == id_reference) {
            quantityProduct = quantityProduct + parseInt(products[i].deliverQuantity)
        }
    }

    if (quantityProduct > 0) {
        if (quantity <= quantityProduct + quantityDeliver) {
            toastr.error('No se puede ingresar una nueva cantidad. Cantidad máxima registrada')
            return false
        }
    }

    /* Crear el objeto con los productos */

    for (let i = 0; i < info.length; i++) {
        if (info[i].id_quote_product == id_reference) {

            info[i].description_product == undefined ? info[i].description_product = '' : info[i].description_product

            product = {}
            product.id_quote_product = info[i].id_quote_product
            product.reference = info[i].reference
            product.product = info[i].product
            product.description = info[i].description_product
            product.quantity = quantity
            product.deliverQuantity = quantityDeliver
            products.push(product)
        }
    }
    selectProductRemission(products)

});


selectProductRemission = (products) => {
    $("#tableProductsRemission > tbody").empty();

    /* Ingresar productos a la remision */

    for (let i = 0; i < products.length; i++) {
        $('#tableProductsRemission > tbody').append(`
                <tr>
                <td class="">${products[i].reference}</td>
                    <td class="text-left">
                        <div class="colwid">
                            <b>${products[i].product}</b><br>
                            ${products[i].description}
                        </div> 
                    </td>
                <td class="text-center">${products[i].deliverQuantity}</td>
                <td class="text-center noImprimir"><a href="javascript:;" id="${i}" <i class="bx bx-trash deleteProduct" data-toggle='tooltip' title='Eliminar Producto' style="font-size: 24px;color:red"></i></a></td>
            </tr>`);
    }

    $('#quantityDeliver').val('');
}

/* Eliminar producto */

$(document).on('click', '.deleteProduct', function(e) {
    e.preventDefault();
    id = this.id
    products.splice(id, 1)
    selectProductRemission(products)
});

/* Crear remisión */

$('#btnCreateRemission').click(function(e) {
    e.preventDefault();

    if (products.length == 0) {
        toastr.error('Adicione al menos un producto para generar la remisión')
        return false
    }

    id_order = sessionStorage.id_order

    $.post(`../../../api/addRemission`, { id_order: id_order, products: products },
        function(data, textStatus, jqXHR) {
            if (data.success) {
                toastr.success(data.message)
                $('#modalCreateRemission').modal('hide');
                updateTable()
            } else
                toastr.error(data.message)
        },
    );
});


loadquantityproductsremission = (value) => {

    for (let i = 0; i < info.length; i++)
        if (info[i].id_quote_product == value) {
            $(`#reference option:contains(${info[i].reference})`).prop('selected', true);
            $(`#product option[value=${info[i].id_quote_product}]`).prop("selected", true);
            $('#quantity').val(info[i].quantity).prop('disabled', true);
            $('#quantityDelivered').val(info[i].delivered).prop('disabled', true);
            $('#quantityDeliver').prop('disabled', false);
            $('#quantityDeliver').val('');
        }
}

function updateTable() {
    $('#tableOrders').DataTable().clear()
    $('#tableOrders').DataTable().ajax.reload()
}