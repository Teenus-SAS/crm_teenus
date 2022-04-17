$(document).ready(function() {
    let counter = 1;

    $('.addProd').hide();
    let products = []

    $('#btnAddNewProduct').click(function(e) {
        e.preventDefault();
        $('.addProd').toggle(1000)
        $('#discount option[value=0]').prop("selected", true);
    });

    $('#btnNewQuote').click(function(e) {
        e.preventDefault();
        $("#formNewQuote")[0].reset();

        $(`#selectContact option:contains('Seleccionar')`).prop('selected', true);
        $(`#selectContact`).empty()
        $(`#selectBusiness`).empty()

        $('#id_quote').val('');
        $('td', tableProductsQuote).remove();
        $('#btnSaveQuote').html('Crear Cotización')
        products.splice(0)
    });

    /* Modificar cantidad, modificar precio */

    $(document).on('click keyup', "#quantity", function(e) {
        e.preventDefault();

        quantity = parseFloat(this.value)

        discount = $('#discount').val();
        discount = parseFloat(discount)

        price = $('#price').val();
        price = price.replace(/[.]/gi, '')
        price = parseFloat(price)

        total = (quantity * price * (1 - (discount / 100))).toLocaleString('de-DE')
        $('#totalPrice').val(total);
    });

    /* Modificar descuento modificar precio */

    $(document).on('change', "#discount", function(e) {
        e.preventDefault();

        discount = parseFloat(this.value)

        quantity = $('#quantity').val();
        quantity = parseFloat(quantity)

        price = $('#price').val();
        price = price.replace(/[.]/gi, '')
        price = parseFloat(price)

        total = (quantity * price * (1 - (discount / 100))).toLocaleString('de-DE')
        $('#totalPrice').val(total);
    });

    /* Adicionar productos a la tabla */

    $('#btnAddProduct').on('click', function(e) {
        e.preventDefault();

        let reference = $("#selectReference option:selected").text();
        let product = $("#selectProducts option:selected").text();
        //let img = $("#imgProduct").prop('src');
        let description = $('#descriptionProduct').val();
        let quantity = $('#quantity').val();
        let discount = $('#discount').val();

        discount == null ? discount = 0 : discount

        let price = $('#price').val();
        //price = parseFloat(price.replace('.', ''))

        $('.addProd').hide();

        if (reference == 'Seleccionar' || product == 'Seleccionar' || quantity == '' || price == '') {
            toastr.error('Para cotizar, ingrese todos los datos de los productos')
            return false
        }

        if (quantity <= 0) {
            toastr.error('La cantidad debe ser mayor a 0')
            return false
        }

        if (price <= 0) {
            toastr.error('El precio debe ser mayor a cero')
            return false
        }

        if (description) {
            description = description.toLowerCase();
            description = description[0].toUpperCase() + description.slice(1);
        }

        price = price.toLocaleString('de-DE')
        price = price.replace(/[.]/gi, '')
        quantity = parseFloat(quantity)
        price = parseFloat(price)
        discount = parseFloat(discount)
        total = (quantity * price * (1 - (discount / 100))).toLocaleString('de-DE')

        product = { reference, product, description, quantity, price, discount, total }
        products.push(product)

        addProducts();

        $("#selectReference").val('');
        $("#selectProducts").val('');
        $('#descriptionProduct').val('');
        $('#quantity').val('');
        $('#price').val('');
        $('#totalPrice').val('');
        $('#discount option[value=0]').prop("selected", true);

    });

    /* Borrar productos seleccionados de la tabla */

    $(document).on('click', '.deleteProduct', function(e) {
        e.preventDefault();

        id = this.id
        products.splice(id, 1)
        addProducts()
    });

    /* Guardar Cotización */

    $('#btnSaveQuote').click(function(e) {
        e.preventDefault();

        let company = $('#selectCompanies').val();
        let contact = $('#selectContact').val();
        let business = $('#selectBusiness').val();
        let id_quote = $('#id_quote').val();

        let paymentMethods = $('#selectPaymentMethods').val();
        let time_quote = $('#time_quote').val();
        let guarantee = $('#guarantee').val();
        let delivery_date = $('#delivery_date').val();

        /* Valida que los datos de contacto y proyecto no esten vacios */

        if (contact == null || business == null || paymentMethods == null || time_quote == '' || guarantee == '' || delivery_date == '') {
            toastr.error('Ingrese todos los datos')
            return false;
        }

        data = $('#formNewQuote').serialize();

        $.ajax({
            type: "POST",
            url: "../../../api/addQuotes",
            data: {
                id_quote: id_quote,
                company: company,
                contact: contact,
                business: business,
                paymentMethods: paymentMethods,
                time_quote: time_quote,
                guarantee: guarantee,
                delivery_date: delivery_date,
                products: products
            },
            success: function(response) {
                if (response.success == true) {
                    toastr.success(response.message)
                    updateTable()
                    $('#modalCreateQuote').modal('hide');
                } else if (response.error == true)
                    toastr.error(response.message)
            }
        });
    });

    /* Ver formulario cotización */

    $(document).on('click', '.seeQuote', function(e) {
        e.preventDefault();
        let id = $(this).prop('id')
        sessionStorage.setItem('id_quote', id)
    });

    /* Actualizar datos de la cotizacion */

    $(document).on('click', '.updateQuote', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')

        $.get(`../../../api/updateQuotes/${id}`,
            function(data, textStatus, jqXHR) {

                $('#modalCreateQuote').modal('show')
                $('#id_quote').val(id);
                $(`#selectCompanies option:contains(${data[0].company_name})`).prop('selected', true);
                contacts(data[0].company_name, data[0].contact)
                business(data[0].company_name, data[0].id_business)

                $(`#selectPaymentMethods option:contains(${data[0].method})`).prop('selected', true);
                $('#time_quote').val(data[0].validity);
                $('#guarantee').val(data[0].guarantee);
                $('#delivery_date').val(data[0].delivery_date);

                $('.addProd').hide();

                $('#selectBusiness').val(data[0].id_business)
                $('#btnSaveQuote').html('Actualizar Cotización')

                /* Eliminacion de filas en tabla */
                $("tbody", tableProductsQuote).remove();
                $('#tableProductsQuote').append($('<tbody></tbody>'));

                products = data
                addProducts()
                    /* Adicion de productos */
                    /* for (let i = 0; i < data.length; i++)
                        addProducts(data[i].reference, data[i].product, data[i].img, data[i].description, data[i].quantity, data[i].price, data[i].discount) */
            });

    });

    /* Crear nuevo pedido desde cotizacion */

    $(document).on('click', '.createOrder', function(e) {
        e.preventDefault();
        let id = $(this).prop('id')
        sessionStorage.setItem('id_quote', id)

        $.get(`../../../api/order_quote/${id}`,
            function(data, textStatus, jqXHR) {
                if (data) {
                    toastr.info('Pedido creado con anterioridad')
                    return false
                } else
                    $('#modalDataOrder').modal('show');
            },
        );
    });

    /* Cancelar creacion del pedido */

    $('#btnCancelOrder').click(function(e) {
        e.preventDefault();
        $("#formNewOrder")[0].reset();
        $('#modalDataOrder').modal('hide');
    });

    /* Guardar pedido */

    $('#btnSaveOrder').click(function(e) {
        e.preventDefault();

        id = sessionStorage.getItem('id_quote')
        data = $('#formNewOrder').serialize() + `&id=${id}`

        fecha = $('#date_delivery').val();

        valor = validationDate(fecha);

        if (valor === 0) {
            toastr.error('La fecha de Entrega debe ser mayor al día de hoy')
            return false
        }

        $.post(`../../../api/addOrder`, data,
            function(data, textStatus, jqXHR) {
                if (data.success) {
                    toastr.success(data.message)
                    $("#formNewOrder")[0].reset();
                    $('#modalDataOrder').modal('hide');
                    updateTable()
                }
                if (data.info)
                    toastr.info(data.message)
            },
        );
    });

    /* Cargar cada producto seleccionado a la tabla */

    const addProducts = () => {

        $("#tableProductsQuote > tbody").empty();

        for (let i = 0; i < products.length; i++) {

            if (products.total == undefined) {
                products[i]['total'] = (products[i].quantity * products[i].price * (1 - (products[i].discount / 100))).toLocaleString('de-DE')
            }

            $('#tableProductsQuote>tbody').append(`
            <tr>
                <td class="text-center">${products[i].reference}</td>
                <td width="12%">${products[i].product}</td>
                <td>${products[i].description == undefined ? '' : products[i].description}</td>
                <td class="text-center">${products[i].quantity}</td>
                <td class="text-center">${products[i].price.toLocaleString('de-DE')}</td>
                <td class="text-center">${products[i].discount}%</td>
                <td class="text-center">${products[i].total}</td>
                <td class="text-center"><a href="javascript:;" id="${i}" <i class="bx bx-trash deleteProduct" data-toggle='tooltip' title='Eliminar Producto' style="font-size: 18px;color:red"></i></a></td>
            </tr>`);
        }
    }

    /* Actualizar tabla */

    function updateTable() {
        $('#tableQuotes').DataTable().clear()
        $('#tableQuotes').DataTable().ajax.reload()
    }

});