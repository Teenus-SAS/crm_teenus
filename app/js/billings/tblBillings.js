$(document).ready(function() {
    /* Cargue tabla de proyectos para facturación */

    tableBillings = $('#tableBillings').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/billings',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [
            {
                title: 'No.',
                data: null,
                className: 'uniqueClassName',
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: 'Fecha Creación',
                data: 'date_register',
                className: 'uniqueClassName',
            },
            {
                title: 'Empresa',
                data: 'company',
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
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + '</div>';
                },
            },
            {
                title: 'Venta Estimada',
                data: 'estimated_sale',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
            },
            {
                title: 'Etapa',
                data: 'sales_phase',
                className: 'uniqueClassName',
            },
            {
                title: '%',
                data: 'percent',
                className: 'uniqueClassName',
                render: (data, type, row) => {
                    return `${(data * 100).toFixed(0).replace('.', ',')}%`;
                },
            },

            {
                title: 'Plazo',
                data: 'term',
                render: (data, type, row) => {
                    return data == 1 ? 'Corto' : data == 2 ? 'Mediano' : 'Largo';
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'seller',
                visible: tipo !== '2',
                className: 'uniqueClassName',
            },
            {
                title: 'N° Factura',
                data: 'id_business',
                // visible: tipo !== '1',
                className: 'uniqueClassName',
                render: function(data, type, row) {
                    return `<input class="form-control" id="numBill-${row + 1}" type="number">`;
                },
            },
        ],
        
    })
});