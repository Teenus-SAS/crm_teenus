$(document).ready(function() {

    $selectRef = $(`#selectReference`)
    $selectRef.empty()

    $selectProd = $(`#selectProducts`)
    $selectProd.empty()

    $selectRef.append(`<option disabled selected>Seleccionar</option>`)
    $selectRef.append(`<option value="1">desme</option>`)
    $selectRef.append(`<option value="2">maweb</option>`)
    $selectRef.append(`<option value="3">tzpre</option>`)
    $selectRef.append(`<option value="4">tzpro</option>`)
    $selectRef.append(`<option value="5">tzpym</option>`)
    $selectRef.append(`<option value="6">tzemp</option>`)

    $selectProd.append(`<option disabled selected>Seleccionar</option>`)
    $selectProd.append(`<option value="1">Desarrollo a la medida</option>`)
    $selectProd.append(`<option value="2">Mantenimiento aplicaciones web</option>`)
    $selectProd.append(`<option value="3">Tezlik-Premium</option>`)
    $selectProd.append(`<option value="4">Tezlik-Pro</option>`)
    $selectProd.append(`<option value="5">Tezlik-Pyme</option>`)
    $selectProd.append(`<option value="6">Tezlik-Emprendedor</option>`)

    $('#selectReference').change(function(e) {
        e.preventDefault();

        ref = $('#selectReference').val();
        $(`#selectProducts option[value=${ref}]`).prop("selected", true);
        $('#quantity').val('1');
    });

    $('#selectProducts').change(function(e) {
        e.preventDefault();
        prod = $('#selectProducts').val()
        $(`#selectReference option[value=${prod}]`).prop("selected", true);
        $('#quantity').val('1');
    });

});