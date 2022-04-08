/* load sellers */
$(document).ready(function() {

    $.ajax({
        url: '../../../api/users',
        success: function(r) {
            sessionStorage.setItem('sellers', JSON.stringify(r))

            let $select = $(`.selectSeller`)
            $select.empty()

            $select.append(`<option disabled selected>Seleccionar...</option>`)

            for (let i = 0; i < r.length; i++) {
                $select.append(
                    `<option value = ${r[i].id_user}> ${r[i].firstname} ${r[i].lastname} </option>`,
                )
            }


            let $selectKanban = $(`.selectSellerKanban`)

            $selectKanban.empty()
            $selectKanban.append(`<option disabled selected>Seleccionar</option>`)
            $selectKanban.append(`<option value='0'>Todos</option>`)

            for (let i = 0; i < r.length; i++) {
                $selectKanban.append(
                    `<option value = ${r[i].id_user}> ${r[i].firstname} ${r[i].lastname} </option>`,
                )
            }
        },
    })
});