/* Tablas iniciales categorias */

$('#categories').toggle();
$('#subcategories').toggle();

$('#cardTableCategoriesUnique').toggle();
$('#cardTableSubCategories').toggle();

$('#btnContactForm').click(function(e) {
    e.preventDefault();
    $('#contactForms').toggle(500);
});


/* Nueva categoria */

$('#btnNewCategory').click(function(e) {
    e.preventDefault();
    $('#subcategories').hide();
    $('#cardTableSubCategories').hide();
    $('#cardTableCategories').hide();

    $('#categories').show(500);
    $('#cardTableCategoriesUnique').show();

});


/* Nueva subcategoria */

$('#btnNewSubcategory').click(function(e) {
    e.preventDefault();

    $('#categories').hide();
    $('#cardTableCategories').hide();
    $('#cardTableCategoriesUnique').hide();

    $('#categories').hide();
    $('#subcategories').show(500);
    $('#cardTableSubCategories').show();

});

/* Creacion Nueva Categoria */

$(document).ready(function() {
    $('#btnCreateCategory').click(function(e) {
        e.preventDefault()
        let data = $('#frmCategory').serialize()

        if (data == undefined || data == '') {
            toastr.error('Ingrese la nueva Categoria')
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '../api/addCategory',
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#categories').hide(500)
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Categoria */

    $(document).on('click', '.updateCategory', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableCategoriesUnique.fnGetData(row)

        $('#categories').show(500)
        $('#id_category').val(data.id_category)
        $('#category').val(data.category)

        $('#btnCreateUser').html('Actualizar Usuario')
    })

    /* Eliminar Categoria */

    $(document).on('click', '.deleteCategory', function(e) {
        e.preventDefault()
        let id = $(this).prop('id')
        let row = $(this).parent().parent()[0]
        let data = tableCategoriesUnique.fnGetData(row)

        alertify.confirm(
            'Proyecformas',
            `¿Realmente desea <b style="color:red">eliminar</b> la Categoria <b style="color:red">${data.category}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `../api/deleteCategory/${id}`,
                    success: function(response) {
                        updateTable()
                        if (response.success == true)
                            toastr.success(response.message)
                        else if (response.error == true)
                            toastr.error(response.message)
                    },
                })
            },
            function() {
                alertify.error('Cancel')
            },
        )
    })
})

/* Cargue tabla de Categorias */

tableCategories = $('#tableCategories').dataTable({
    pageLength: 50,
    ajax: {
        url: '../../../api/categories',
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
            title: 'Subcategorias',
            data: 'subcategory',
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

/* Cargue tabla de Categorias */

tableCategoriesUnique = $('#tableCategoriesUnique').dataTable({
    pageLength: 50,
    ajax: {
        url: '../../../api/categoriesUnique',
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

/* Cargue tabla de SubCategorias */

tableSubCategories = $('#tableSubCategories').dataTable({
    pageLength: 50,
    ajax: {
        url: '../../../api/categories',
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

/* Actualizar tabla */

function updateTable() {
    $('#tableCategories').DataTable().clear()
    $('#tableCategories').DataTable().ajax.reload()

    $('#tableCategoriesUnique').DataTable().clear()
    $('#tableCategoriesUnique').DataTable().ajax.reload()

    $('#tableSubCategories').DataTable().clear()
    $('#tableSubCategories').DataTable().ajax.reload()
}