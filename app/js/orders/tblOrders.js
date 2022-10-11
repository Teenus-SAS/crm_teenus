$(document).ready(function() {
    /* Cargue tabla de cotizaciones */

    tableOrders = $('#tableOrders').dataTable({
        pageLength: 50,
        destroy: true,
        ajax: {
            url: '/api/orders',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                className: 'uniqueClassName',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Fecha Pedido',
                data: 'date_register',
                className: 'uniqueClassName',
            },
            {
                title: 'Cotización No.',
                data: 'id_quote',
                visible: tipo != '3',
                className: 'uniqueClassName',
            },
            {
                title: 'Pedido No.',
                data: 'id_order',
                className: 'uniqueClassName',
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
                visible: tipo != '3',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Asesor Comercial',
                data: 'asesor',
                visible: tipo != '2',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_order',
                visible: tipo == '2',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" <i id="${data}"" class="lni lni-target modifyDataDeliveryOrder" data-toggle='tooltip' title='Modificar Datos de Entrega' style="font-size: 35px;"></i></a>    
                    <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/commercial/order.php')"  <i id="${data}"" class="lni lni-eye seeOrder" data-toggle='tooltip' title='Ver Pedido' style="font-size: 35px;"></i></a>`
                },
            },
            {
                title: 'Acciones',
                data: 'id_order',
                visible: tipo == '1',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/commercial/order.php')"  <i id="${data}"" class="lni lni-eye seeOrder" data-toggle='tooltip' title='Ver Pedido' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}"" class="bx bx-x cancelOrder" data-toggle='tooltip' title='Anular Pedido' style="font-size: 35px;color:red"></i></a>`
                },
            },

            {
                title: 'Acciones',
                data: 'id_order',
                visible: tipo == '3',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/commercial/order.php')"  <i id="${data}"" class="lni lni-eye seeOrder" data-toggle='tooltip' title='Ver Pedido' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}"" class="bx bxs-truck createRemission" data-toggle='tooltip' title='Generar Remisión' style="font-size: 35px;color:green"></i></a>`
                },
            },
        ],

        "createdRow": function(row, data, dataIndex) {
            if (data.status == `1`) {
                $(row).addClass('colorRowClass');
            }
        },

        "footerCallback": function(row, data, start, end, display) {
            if (tipo != '3') {
                total = this.api()
                    .column(7) //numero de columna a sumar
                    //.column(1, {page: 'current'})//para sumar solo la pagina actual
                    .data()
                    .reduce(function(a, b) {
                        return parseInt(a) + parseInt(b);
                    }, 0);

                $(this.api().column(1).footer()).html(`Total Pedidos: $ ${total.toLocaleString("en-US")}`);
            }
        }
    })
})