/* Cargue tabla de usuarios */

tableBudgets = $('#tableBudgets').dataTable({
    pageLength: 10,
    searching: false,
    paging: false,
    info: false,
    ajax: {
        url: '../../../api/budgetUser',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'Enero',
            data: 'jan',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Febrero',
            data: 'feb',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Marzo',
            data: 'mar',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Abril',
            data: 'apr',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Mayo',
            data: 'may',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Junio',
            data: 'june',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Julio',
            data: 'july',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Agosto',
            data: 'aug',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Septiembre',
            data: 'sept',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Octubre',
            data: 'oct',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Noviembre',
            data: 'nov',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
        {
            title: 'Diciembre',
            data: 'decem',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, '$ '),
        },
    ],
});