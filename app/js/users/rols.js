/* load rols app */

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "../api/rols",

        success: function(r) {
            sessionStorage.setItem('rols', JSON.stringify(r))

            let $select = $(`.rol`)
            $select.empty()

            $select.append(`<option disabled selected>Seleccionar...</option>`)

            for (let i = 0; i < r.length; i++) {
                $select.append(
                    `<option value = ${r[i].id_rol}> ${r[i].rol} </option>`,
                )
            }
        }
    });
});

/* Accesso para eliminar pedidos a traves del rol */

$('.access').hide();

$('.rol').change(function(e) {
    e.preventDefault();
    val = this.value
    if (val == 1)
        $('.access').show(100);
    else
        $('.access').hide(100);
});