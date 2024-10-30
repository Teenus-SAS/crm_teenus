/* Create new business */

$(document).ready(function() {
    $('#btnSaveBusiness').click(function(e) {
            e.preventDefault()
            let data = $('#formNewBusiness').serialize()

            $.ajax({
                type: 'POST',
                url: '/api/addBusiness',
                data: data,
                success: function(response, jqXHR, statusCode) {

                    if (response.success == true) {
                        $('#modalCreateBusiness').modal('hide')
                        $("#formNewBusiness")[0].reset();
                        updateTable()
                        toastr.success(response.message)
                    } else if (response.error == true)
                        toastr.error(response.message)

                }
            })
        })
        /* Actualizacion Usuario */

    $(document).on('click', '.updateBusiness', function(e) {
        e.preventDefault()
        let row = $(this).parent().parent()[0]
        let data = tableBusiness.DataTable().row(row).data();

        $('#modalCreateBusiness').modal('show')
        $('#id_business').val(data.id_business)
        $('#name_business').val(data.name_business)

        $(`#selectCompanies option:contains(${data.company})`).prop('selected', true);

        $('#selectContact').change()
        $(`#selectContact option:contains(${data.contact})`).prop('selected', true);

        $('#saleEstimated').val(data.estimated_sale)
        $('#selectSalesPhase').val(data.id_phase)
        $('#selectSalesPhase').change()
        $(`#selectTerm option[value='${data.term}']`).prop("selected", true);

        $('#businessObservations').val(data.observation)
        $('#btnSaveBusiness').html('Actualizar Usuario')
    })

    /* Eliminar Usuario */

    $(document).on('click', '.eliminar', function(e) {
        e.preventDefault()
        const texto = $(this).parent().parent().children()[0]
        const texto1 = $(this).parent().parent().children()[3]
        const id = $(texto).text()
        const email = $(texto1).text()

        alertify.confirm(
            'teenus',
            `¿Realmente desea eliminar el usuario <b>${email}</b>?, esta acción no se puede reversar`,
            function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/deleteUser',
                    data: { idUser: id },
                    success: function(r) {
                        if (r == null) toastr.success('Usuario no puede eliminarse', 'error')
                        else toastr.success('Usuario eliminado', 'success')
                        updateTable()
                    },
                })
            },
            function() {
                alertify.error('Cancel')
            },
        )
    })

    /* Cargar Selects Business */



    /* load phases */

    $.ajax({
        url: '/api/salesPhases',
        success: function(r) {
            sessionStorage.setItem('salesPhases', JSON.stringify(r))

            let $select = $(`#selectSalesPhase`)
            $select.empty()

            $select.append(`<option disabled selected>Seleccionar...</option>`)

            for (let i = 0; i < r.length; i++) {
                $select.append(
                    `<option value = ${r[i].id_phase}> ${r[i].sales_phase} </option>`,
                )
            }
        },
    })




    /* Load percent sales phase */

    $('#selectSalesPhase').change(function(e) {
        e.preventDefault()

        listSalesPhase = sessionStorage.getItem('salesPhases')
        list = JSON.parse(listSalesPhase)

        salesPhase = $('#selectSalesPhase').val()

        for (let i = 0; i < list.length; i++) {
            if (salesPhase == list[i].id_phase) {
                $('#percentSalesPhase').val(`${list[i].percent * 100}%`)
            }
        }
    })

    /* load sellers */

    $.ajax({
        url: '/api/users',
        success: function(r) {
            sessionStorage.setItem('sellers', JSON.stringify(r))

            let $select = $(`#selectSeller`)
            $select.empty()

            $select.append(`<option disabled selected>Seleccionar...</option>`)

            for (let i = 0; i < r.length; i++) {
                $select.append(
                    `<option value = ${r[i].id_user}> ${r[i].firstname} ${r[i].lastname} </option>`,
                )
            }
        },
    })


    /* update table */

    function updateTable() {
        $('#tableBusiness').DataTable().clear()
        $('#tableBusiness').DataTable().ajax.reload()
    }
})