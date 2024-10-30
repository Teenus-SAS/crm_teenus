$(document).ready(function() {
    /* Cargue tabla de proyectos para facturación */

    tableBillings = $('#tableBillings').DataTable({
        pageLength: 50,
        ajax: {
            url: '/api/billings',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
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
                title: 'Asesor Comercial',
                data: 'seller',
                visible: tipo !== '2',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_business',
                className: 'uniqueClassName',
                render: function (data) {
                    return `<a href="javascript:;" <i id="${data}" class="bx bx-check-circle payBilling" data-toggle='tooltip' title='Pagado' style="font-size: 30px; color: green;"></i></a>
                    <a href="javascript:;" <i id="${data}"" class="bx bx-edit-alt updateBusiness" data-toggle='tooltip' title='Actualizar Proyecto' style="font-size: 35px;"></i></a>
                    `    
                },
            },
        ],
        
    })
});