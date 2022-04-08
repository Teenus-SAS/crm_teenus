/* Cargue tabla de Categorias */

tableCategoriesUnique = $('#tableCategoriesUnique').dataTable({
    pageLength: 50,
    ajax: {
        url: '/api/categoriesUnique',
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
            title: 'Categorias',
            data: 'category',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id_category',
            render: function(data) {
                return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateCategory" data-toggle='tooltip' title='Editar Categoria' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteCategory" data-toggle='tooltip' title='Eliminar Categoria' style="font-size: 35px;color:red"></i></a>`
            }
        },
    ],
})