/* cargar contacto de acuerdo con seleccion */

async function contacts(company, contact) {
    try {
        let res = await fetch('/api/contacts')
        r = await res.json()

        $select = $(`#selectContact`)
        $select.empty()
        for (let i = 0; i < r.length; i++) {
            if (company == r[i].company_name) {
                $select.append(
                    `<option option value = ${r[i].id_contact}> ${r[i].firstname} ${r[i].lastname} </option > `,
                )
            }
        }

        $(`#selectContact option:contains(${data.contact})`).prop('selected', true);

    } catch (error) {
        console.log(error)
    }
}