/* Cargue tabla de SubCategorias */

tableSubCategories = $('#tableSubCategories').dataTable({
    pageLength: 50,
    ajax: {
        url: '/api/categories',
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
            title: 'Subcategorias',
            data: 'subcategory',
            className: 'uniqueClassName',
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
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt editMethod" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteUser" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>`
            }
        },
    ],
})