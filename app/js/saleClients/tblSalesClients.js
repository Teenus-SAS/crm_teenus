$(document).ready(function () {
    tableSalesClients = $('#tableSalesClients').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/salesClients',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
            title: 'No.',
            data: null,
            className: 'uniqueClassName',
            render: function (data, type, full, meta) {
                return meta.row + 1;
            },
        },
        {
            title: 'Nombres',
            data: 'firstname',
            className: 'uniqueClassName',
        },
        {
            title: 'Apellidos',
            data: 'lastname',
            className: 'uniqueClassName',
        },
        {
            title: 'Telefono',
            data: 'cellphone',
            className: 'uniqueClassName',
        },
        {
            title: 'Email',
            data: 'email',
            className: 'uniqueClassName',
        },
        {
            title: 'Cargo',
            data: 'position',
            className: 'uniqueClassName',
        },
        {
            title: 'Empresa',
            data: 'company',
            className: 'uniqueClassName',
        },
        {
            title: 'Ventas',
            data: 'sales',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_sale_client', 
            className: 'uniqueClassName',
            render: function (data) {
                return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-edit-alt editSaleClient" data-toggle='tooltip' title='Editar Cliente' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-trash" data-toggle='tooltip' title='Eliminar Cliente' style="font-size: 30px;color:red" onclick="deleteFunction()"></i></a>
                `;
            },
        },
        ],
    });
});