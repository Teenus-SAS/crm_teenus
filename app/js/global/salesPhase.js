/* cargar contacto de acuerdo con seleccion */

 salesPhase = async() =>{
    try {
        let res = await fetch('/api/salesPhases')
        r = await res.json();

        sessionStorage.setItem('salesPhases', JSON.stringify(r))

            let $select = $(`#selectSalesPhase`)
            $select.empty()

            $select.append(`<option disabled selected>Seleccionar...</option>`)

            for (let i = 0; i < r.length; i++) {
                $select.append(
                    `<option value = ${r[i].id_phase}> ${r[i].sales_phase} </option>`,
                )
            }

    } catch (error) {
        console.log(error)
    }
}