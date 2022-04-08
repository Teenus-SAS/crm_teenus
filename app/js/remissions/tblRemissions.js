$(document).ready(function() {
    /* Cargue tabla de cotizaciones */

    tableRemissions = $('#tableRemissions').dataTable({
        pageLength: 50,
        ajax: {
            url: '../../../api/remissions',
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
                title: 'Fecha Remisión',
                data: 'date_register',
                className: 'uniqueClassName',
            },
            {
                title: 'Pedido No.',
                data: 'id_order',
                className: 'uniqueClassName',
            },
            {
                title: 'Remisión No.',
                data: 'id_remission',
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
            /*  {
                 title: 'Asesor Comercial',
                 data: 'asesor',
                 visible: tipo == '1',
                 className: 'uniqueClassName',
             }, */
            {
                title: 'Modificar',
                data: 'id_order',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                        <a href="javascript:;" <i id="${data}"" class="lni lni-target modifyDataDeliveryRemission" data-toggle='tooltip' title='Modificar Datos de Entrega' style="font-size: 35px;"></i></a>`
                },
            },
            {
                title: 'Remisión',
                data: 'id_remission',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                        <a href="javascript:;" onclick="cargarContenido('page-content','/app/views/remissions/remission.php')"  <i id="${data}" class="lni lni-eye seeRemission" data-toggle='tooltip' title='Ver Remisión' style="font-size: 35px;"></i></a>`
                },
            },
        ],

        /* "footerCallback": function(row, data, start, end, display) {

            total = this.api()
                .column(7) //numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0);

            $(this.api().column(1).footer()).html(`Total Pedidos: $ ${total.toLocaleString("en-US")}`);

        } */
    })
})

/* <a href="javascript:;" <i id="${data}" class="bx bxs-printer generateRemission" data-toggle='tooltip' title='Generar Remisión' style="font-size: 35px;"></i></a> */