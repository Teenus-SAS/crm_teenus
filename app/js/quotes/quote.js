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



    /* Adicionar productos a la tabla */

    $('#btnAddProduct').on('click', function(e) {
        e.preventDefault();
        let product = $("#products").val();
        let price = $('#price').val();
        price = parseFloat(price.replace('.', ''))


        $('.addProd').hide();

        if (product == '' || price == '') {
            toastr.error('Para cotizar, ingrese todos los datos de los productos')
            return false
        }

        if (price <= 0) {
            toastr.error('El precio debe ser mayor a cero')
            return false
        }

        price = price.toLocaleString('de-DE')
        price = price.replace(/[.]/gi, '')
        price = parseFloat(price)

        product = { product, price }
        products.push(product)

        addProducts();

        $('#products').val('');
        $('#price').val('');

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
            url: "/api/addQuotes",
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

    /*  $(document).on('click', '.seeQuote', function(e) {
         e.preventDefault();
         let id = $(this).prop('id')
         sessionStorage.setItem('id_quote', id)
     }); */

    /* Actualizar datos de la cotizacion */

    $(document).on('click', '.updateQuote', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')

        $.get(`/api/updateQuotes/${id}`,
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

            });

    });


    /* Actualizar tabla */

    function updateTable() {
        $('#tableQuotes').DataTable().clear()
        $('#tableQuotes').DataTable().ajax.reload()
    }

});