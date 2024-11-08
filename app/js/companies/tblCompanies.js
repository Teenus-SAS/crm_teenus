$(document).ready(function() {
    /* Cargue tabla de Empresas */
    tableCompanies = $('#tableCompanies').dataTable({
        pageLength: 50,

        ajax: {
            url: '/api/companies',
            dataSrc: '',
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                data: null,
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: 'Nit',
                data: 'nit',
                className: 'uniqueClassName',
            },
            {
                title: 'Razon Social',
                data: 'company_name',
                className: 'uniqueClassName',
            },
            {
                title: 'Dirección',
                data: 'address',
                className: 'uniqueClassName',
            },
            {
                title: 'Teléfono',
                data: 'phone',
                className: 'uniqueClassName',
            },
            {
                title: 'Ciudad',
                data: 'city',
                className: 'uniqueClassName',
            },

            {
                title: 'Categoria',
                data: 'category',
                className: 'uniqueClassName',
            },
            {
                title: 'Subcategoria',
                data: 'subcategory',
                className: 'uniqueClassName',
            },
            {
                title: 'Ventas',
                data: 'sales',
                className: 'uniqueClassName',
            },
            {
                title: 'Asesor Comercial',
                data: 'seller',
                visible: tipo !== '2',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_company',
                className: 'uniqueClassName',
                visible: tipo !== '1',
                render: function(data) {
                    return `
                <a href="javascript:;" <i id="${data}"" class="bx bx-edit-alt editCompany" data-toggle='tooltip' title='Actualizar Datos Empresa' style="font-size: 35px;"></i></a>`;
                },
            },
            {
                title: 'Acciones',
                data: 'id_company',
                className: 'uniqueClassName',
                visible: tipo !== '2',
                render: function(data) {
                    return `
                <a href="javascript:;" <i id="${data}"" class="bx bx-transfer reassignCompany" data-toggle='tooltip' title='Reasignar Empresa a Nuevo Comercial' style="font-size: 35px;"></i></a>`;
                },
            },
        ],
    });
});