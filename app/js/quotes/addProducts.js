$(document).ready(function() {
    /* Cargar cada producto seleccionado a la tabla */

    const addProducts = () => {

        $("#tableProductsQuote > tbody").empty();

        for (let i = 0; i < products.length; i++) {

            if (products.total == undefined) {
                products[i]['total'] = (products[i].quantity * products[i].price * (1 - (products[i].discount / 100))).toLocaleString('de-DE')
            }

            $('#tableProductsQuote>tbody').append(`
        <tr>
            <td class="text-center">${products[i].product}</td>              
            <td class="text-center">${products[i].price.toLocaleString('de-DE')}</td>
            <td class="text-center"><a href="javascript:;" id="${i}" <i class="bx bx-trash deleteProduct" data-toggle='tooltip' title='Eliminar Producto' style="font-size: 18px;color:red"></i></a></td>
        </tr>`);
        }
    }
});