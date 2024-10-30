$(document).ready(function() {
    /* Cargue tabla de cotizaciones */

    tableQuotes = $('#tableQuotes').dataTable({
        pageLength: 50,
        ajax: {
            url: '../../../api/quotes',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                className: 'uniqueClassName1',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Cotización No.',
                data: 'id_quote',
                className: 'uniqueClassName1',
            },
            {
                title: 'Empresa',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Contacto',
                data: 'contact',
                className: 'uniqueClassName',
            },
            {
                title: 'Proyecto',
                data: 'name_business',
                className: 'uniqueClassName',
            },
            {
                title: 'Precio',
                data: 'price',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Fecha',
                data: 'date_register',
                className: 'uniqueClassName',
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo == '1',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_quote',
                visible: tipo !== '2',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/commercial/quote.php')"  <i id="${data}" class="lni lni-eye seeQuote" data-toggle='tooltip' title='Ver Cotización' style="font-size: 35px;"></i></a>
                    `
                },
            },
            {
                title: 'Acciones',
                data: 'id_quote',
                visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/commercial/quote.php')"  <i id="${data}" class="lni lni-eye seeQuote" data-toggle='tooltip' title='Ver Cotización' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-edit-alt updateQuote" data-toggle='tooltip' title='Editar Cotización' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-box createOrder" data-toggle='tooltip' title='Crear Pedido' style="font-size: 35px;color:mediumseagreen"></i></a>`
                },
            },
        ],
        "createdRow": function(row, data, dataIndex) {
            if (data.status == `1`) {
                $(row).addClass('colorRowClass');
            }
        }
    })
});