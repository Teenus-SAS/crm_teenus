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
            url: '/api/addCategory',
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
            'teenus',
            `¿Realmente desea <b style="color:red">eliminar</b> la Categoria <b style="color:red">${data.category}</b>?, esta acción es permanente`,
            function() {
                $.ajax({
                    url: `/api/deleteCategory/${id}`,
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

/* Actualizar tablas */

function updateTable() {
    $('#tableCategories').DataTable().clear()
    $('#tableCategories').DataTable().ajax.reload()

    $('#tableCategoriesUnique').DataTable().clear()
    $('#tableCategoriesUnique').DataTable().ajax.reload()

    $('#tableSubCategories').DataTable().clear()
    $('#tableSubCategories').DataTable().ajax.reload()
}