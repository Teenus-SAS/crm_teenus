$(document).ready(function() {

    $('#price').prop('disabled', true);

    /* (() => {
        fetch('https://v2.tezliksoftware.com.co/api/products')
            .then((res) => (res.ok ? res.json() : Promise.reject(res)))
            .then((json) => {

                $selectRef = $(`#selectReference`)
                $selectRef.empty()

                $selectProd = $(`#selectProducts`)
                $selectProd.empty()

                $selectRef.append(`<option disabled selected>Seleccionar</option>`)
                $selectProd.append(`<option disabled selected>Seleccionar</option>`)

                for (let i = 0; i < json.length; i++) {
                    $selectRef.append(`<option value = ${json[i].id_producto}> ${json[i].ref} </option>`, )
                    $selectProd.append(`<option value = ${json[i].id_producto}> ${json[i].nombre} </option>`, )

                }
            })
            .catch((err) => { console.log(err) })
    })(); */

    $selectRef = $(`#selectReference`)
    $selectRef.empty()

    $selectProd = $(`#selectProducts`)
    $selectProd.empty()

    $selectRef.append(`<option disabled selected>Seleccionar</option>`)
    $selectProd.append(`<option value="1">des-m1</option>`)
    $selectProd.append(`<option value="2">tez-t1</option>`)

    $selectProd.append(`<option disabled selected>Seleccionar</option>`)
    $selectProd.append(`<option value="1">Desarrollo a la medida</option>`)
    $selectProd.append(`<option value="2">Tezlik</option>`)


});

$('#selectReference').change(function(e) {
    e.preventDefault();

    search = $('#selectReference').val()
    var select = document.getElementById("selectProducts");
    /* select = $('#selectProducts') */
    for (var i = 1; i < select.length; i++) {
        if (select.options[i].value == search) {
            select.selectedIndex = i;
        }
    }
});

$('#selectProducts').change(function(e) {
    e.preventDefault();

    search = $('#selectProducts').val()
    var select = document.getElementById("selectReference");
    /* select = $('#selectProducts') */
    for (var i = 1; i < select.length; i++) {
        if (select.options[i].value == search) {
            select.selectedIndex = i;
        }
    }
});