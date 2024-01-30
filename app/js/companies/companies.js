$(document).ready(function() {

    $('#btnCreateCompany').click(function(e) {
        e.preventDefault();
        $select = $(`#selectSubcategory`)
        $select.empty()
    });

    /* Crear nueva empresa */

    $('#btnSaveCompany').click(function(e) {
        e.preventDefault()
        sessionStorage.removeItem('companies_contacts')
            /* nit = $('#nit').val();

            if (nit == '') {
                toastr.error('Ingrese el Nit sin puntos, comas o guiones')
                return false
            } */

        let data = $('#formNewCompany').serialize()

        $.ajax({
            type: 'POST',
            url: '/api/addCompany',
            data: data,
            success: function(response, jqXHR, statusCode) {
                if (response.success) {
                    $('#modalCreateCompany').modal('hide')
                    $("#formNewCompany")[0].reset();
                    $('#selectSubcategory').empty().append('Seleccionar');
                    toastr.success(response.message)
                    updateTable()
                }
                if (response.error)
                    toastr.error(response.message)
            },
        })
    })

    /* Actualizacion Empresa */

    $(document).on('click', '.editCompany', function(e) {
        e.preventDefault()
        $('#btnCreateCompany').click()
        let row = $(this).parent().parent()[0]
        let data = tableCompanies.fnGetData(row)

        $('#modalCreateCompany').modal('show')

        $('#id_company').val(data.id_company)
        $('#nit').val(data.nit)
        $('#company_name').val(data.company_name)
        $('#address').val(data.address)
        $('#phone').val(data.phone)
        $('#city').val(data.city)

        $(`#selectCategory option:contains(${data.category})`).prop('selected', true);

        categories(data.category, data.subcategory);

        //$(`#selectSubcategory option:contains(${data.subcategory})`).prop('selected', true);
        //$(`#selectZone option:contains(${data.zone})`).prop('selected', true);

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


    /* cargar categoria de acuerdo con seleccion */

    async function categories(category, subcategory) {
        try {
            let res = await fetch('/api/categories')
            r = await res.json()

            $select = $(`#selectSubcategory`)
            $select.empty()
            for (let i = 0; i < r.length; i++) {
                if (category == r[i].category) {
                    $select.append(
                        `<option option value = ${r[i].id_subcategory}> ${r[i].subcategory} </option > `,
                    )
                }
            }
            $(`#selectSubcategory option:contains(${subcategory})`).prop('selected', true);

        } catch (error) {

        }
    }

    /* Actualizar tabla */

    function updateTable() {
        $('#tableCompanies').DataTable().clear()
        $('#tableCompanies').DataTable().ajax.reload()
    }
})