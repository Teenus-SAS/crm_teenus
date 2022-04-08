/* Load companies */

/* $(document).ready(function() {

    $('#selectCompanies').change(function(e) {
        e.preventDefault();
        id_company = $('#selectCompanies').val()

        $.ajax({
            url: `../../../api/businessCompany/${id_company}`,
            success: function(r) {

                let $select = $(`#selectBusiness`)
                $select.empty()

                $select.append(`<option disabled selected>Seleccionar</option>`)
                $.each(r, function(i, value) {
                    $select.append(
                        `<option value = ${value.id_business}> ${value.name_business} </option>`,
                    )
                })
            },
        })
    })

})
 */

/* cargar proyecto de acuerdo con seleccion de empresa */

async function business(company, business) {

    try {
        let res = await fetch('../../../api/business')
        r = await res.json()

        $select = $(`#selectBusiness`)
        $select.empty()
        for (let i = 0; i < r.length; i++) {
            if (company == r[i].company) {
                $select.append(
                    `<option option value = ${r[i].id_business}> ${r[i].name_business}</option > `,
                )
            }
        }

        $('#selectBusiness').val(business);
        //$(`#selectContact option:contains(${data.contact})`).prop('selected', true);

    } catch (error) {
        console.log(error)
    }
}