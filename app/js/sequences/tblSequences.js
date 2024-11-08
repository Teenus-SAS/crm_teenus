$(document).ready(function () {
    tableSequences = $('#tableSequences').dataTable({
        destroy: true,
        pageLength: 50,
        ajax: {
            url: '/api/sequences',
            dataSrc: '',
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
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
            title: 'Secuencia',
            data: 'name_sequence',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_sequence',
            className: 'uniqueClassName',
            render: function (data) {
                return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-edit-alt editSequence" data-toggle='tooltip' title='Editar Secuencia' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-trash" data-toggle='tooltip' title='Eliminar Secuencia' style="font-size: 30px;color:red" onclick="deleteFunction()"></i></a>
                `;
            },
        },
        ],
    });
});