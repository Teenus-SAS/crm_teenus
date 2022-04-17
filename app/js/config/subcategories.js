$(document).ready(function() {

    /* Nueva subcategoria */

    $('#btnNewSubcategory').click(function(e) {
        e.preventDefault();

        $('#categories').hide();
        $('#cardTableCategories').hide();
        $('#cardTableCategoriesUnique').hide();

        $('#categories').hide();
        $('#subcategories').show(500);
        $('#cardTableSubCategories').show();

        $("#selectCategory option:contains( Categorias)").prop('selected', true);
        $('#subcategory').val('');

    });


    /* Creacion Nueva SubCategoria */

    $('#btnCreatesubcategory').click(function(e) {
        e.preventDefault()
        debugger
        let data = $('#frmSubcategory').serialize()

        if (data == undefined || data == '') {
            toastr.error('Ingrese la nueva Categoria')
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '/api/addSubcategory',
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#subcategories').hide(500)
                updateTable()
                if (response.success == true)
                    toastr.success(response.message)
                if (response.error == true)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Categoria */

    $(document).on('click', '.updateSubcategory', function(e) {
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