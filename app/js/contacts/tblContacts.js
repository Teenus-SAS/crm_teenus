$(document).ready(function () {
    /* Cargue tabla de contactos */
    tableContacts = $('#tableContacts').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/contacts',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
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
            title: 'Telefono 1',
            data: 'phone',
            className: 'uniqueClassName',
        },
        {
            title: 'Teléfono 2',
            data: 'phone1',
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
            data: 'company_name',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_contact',
            visible: tipo !== '1',
            className: 'uniqueClassName',
            render: function (data) {
                return `<a href="javascript:;" <i id="${data}" class="bx bx-edit-alt editContact" data-toggle='tooltip' title='Editar Contacto' style="font-size: 35px;"></i></a>`;
            },
        },
        ],
    });
});