/* load zonas */

$.ajax({
    url: '../../../api/zones',
    success: function(r) {
        sessionStorage.setItem('zones', JSON.stringify(r))

        let $select = $(`.selectZone`)
        $select.empty()

        $select.append(`<option disabled selected>Seleccionar...</option>`)

        for (let i = 0; i < r.length; i++) {
            $select.append(
                `<option value = ${r[i].id_zone}> ${r[i].zone} </option>`,
            )
        }
    },
})