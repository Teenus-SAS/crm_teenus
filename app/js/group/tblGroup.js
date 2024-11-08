$(document).ready(function () { 
    loadTblGroups = (data) => {
        tableGroups = $('#tableGroups').dataTable({
            destroy: true,
            pageLength: 50,
            data: data,
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
                title: 'Grupo',
                data: 'name_group',
                className: 'uniqueClassName',
            },
            {
                title: 'Acciones',
                data: 'id_group',
                className: 'uniqueClassName',
                render: function (data) {
                    return `
                    <a href="javascript:;" <i id="${data}" class="bx bx-edit-alt editGroup" data-toggle='tooltip' title='Editar Grupo' style="font-size: 35px;"></i></a>
                    <a href="javascript:;" <i id="${data}" class="bx bx-trash" data-toggle='tooltip' title='Eliminar Grupo' style="font-size: 30px;color:red" onclick="deleteGRFunction()"></i></a>
                `;
                },
            },
            ],
        });
    }
});