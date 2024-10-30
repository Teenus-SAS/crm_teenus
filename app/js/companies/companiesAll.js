/* Create new company */

$(document).ready(function() {
    $('#btnSaveCompany').click(function(e) {
        e.preventDefault()
        sessionStorage.removeItem('companies_contacts')
        let data = $('#formNewCompany').serialize()

        $.ajax({
            type: 'POST',
            url: '/api/addCompany',
            data: data,
            success: function(response, jqXHR, statusCode) {
                $('#modalCreateCompany').modal('hide')
                $("#formNewCompany")[0].reset();
                $('#selectSubcategory').empty().append('Seleccionar');
                if (response.success)
                    toastr.success(response.message)
                if (response.error)
                    toastr.success(response.message)
                updateTable()
            },
        })
    })

    /* Actualizacion Empresa */

    $(document).on('click', '.editCompany', function(e) {
        e.preventDefault()
        $('#btnCreateCompany').click()
        let row = $(this).parent().parent()[0]
        let data = tableCompanies.DataTable().row(row).data();

        $('#modalCreateCompany').modal('show')
        $('#id').val(data.id_company)
        $('#nit').val(data.nit)
        $('#company_name').val(data.company_name)
        $('#address').val(data.address)
        $('#phone').val(data.phone)
        $('#city').val(data.city)

        $(`#selectCategory option:contains(${data.category})`).prop('selected', true);
        $(`#selectSubcategory option:contains(${data.subcategory})`).prop('selected', true);
        $(`#selectZone option:contains(${data.zone})`).prop('selected', true);

        $('#btnSaveCompany').html('Actualizar Empresa')
    })


    /* Eliminar Empresa */

    $(document).on('click', '.eliminar', function(e) {
        e.preventDefault()
        const texto = $(this).parent().parent().children()[0]
        const texto1 = $(this).parent().parent().children()[3]
        const id = $(texto).text()
        const email = $(texto1).text()

        alertify.confirm(
            'teenus',
            `¿Realmente desea eliminar el usuario <b b > ${email}</b >?, esta acción no se puede reversar`,
            function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/deleteUser',
                    data: { idUser: id },
                    success: function(r) {
                        if (r == null) toastr.success('Usuario no puede eliminarse', 'error')
                        else toastr.success('Usuario eliminado correctamente')
                        updateTable()
                    },
                })
            },
            function() {
                alertify.error('Cancel')
            },
        )
    })

    /* Cargar Categorias y Subcategorias */

    $('#btnCreateCompany').click(function(e) {
        e.preventDefault()

        $('#id').val('');
        $('#titleNewContact').html('Crear Empresa')
        $('#btnSaveCompany').html('Crear Empresa')
        $("#formNewCompany")[0].reset();
    })

    $.ajax({
        url: '/api/zones',
        success: function(r) {
            sessionStorage.setItem('zones', JSON.stringify(r))

            let $select = $(`#selectZone`)
            $select.empty()

            $select.append(`<option option disabled selected > Seleccionar</option > `)

            for (let i = 0; i < r.length; i++) {
                if (i == 0) {
                    $select.append(
                        `<option option value = ${r[i].id_zone}> ${r[i].zone} </option > `,
                    )
                } else if (r[i].id_category != r[i - 1].id_zone) {
                    $select.append(
                        `<option option value = ${r[i].id_zone}> ${r[i].zone} </option > `,
                    )
                }
            }
        },
    })


    /* Cargar subcategorias */

    $('#selectCategory').change(function(e) {
        e.preventDefault();


        $select = $(`#selectSubcategory`)
        $select.empty()

        categories = sessionStorage.getItem('categories')
        r = JSON.parse(categories)
        category = $('#selectCategory').val()

        for (let i = 0; i < r.length; i++) {
            if (category == r[i].id_category) {
                $select.append(
                    `<option option value = ${r[i].id_subcategory}> ${r[i].subcategory} </option > `,
                )
            }
        }
    });


    /* Actualizar tabla */

    function updateTable() {
        $('#tableCompanies').DataTable().clear()
        $('#tableCompanies').DataTable().ajax.reload()
    }
})