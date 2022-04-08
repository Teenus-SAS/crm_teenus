$(document).ready(function() {

    $('#price').prop('disabled', true);

    (() => {
        fetch('https://v2.tezliksoftware.com.co/api/products')
            .then((res) => (res.ok ? res.json() : Promise.reject(res)))
            .then((json) => {

                $selectRef = $(`#selectReference`)
                $selectRef.empty()

                $selectProd = $(`#selectProducts`)
                $selectProd.empty()

                $selectRef.append(`<option disabled selected>Seleccionar</option>`)
                $selectProd.append(`<option disabled selected>Seleccionar</option>`)
                sessionStorage.setItem('prods', JSON.stringify(json));

                for (let i = 0; i < json.length; i++) {

                    producto = primeraLetraMayuscula(json[i].nombre)
                    $selectRef.append(`<option value = ${json[i].id_producto}> ${json[i].ref} </option>`, )
                    $selectProd.append(`<option value = ${json[i].id_producto}> ${producto} </option>`, )

                }
            })
            .catch((err) => { console.log(err) })
    })();
});

$('#selectReference').change(function(e) {
    e.preventDefault();

    search = $('#selectReference').val()
    select = $('#selectProducts')
    let obj = JSON.parse(sessionStorage.getItem('prods'));

    for (let i = 0; i < obj.length; i++) {
        if (obj[i].id_producto == search) {
            $('#selectProducts').val(obj[i].id_producto);
            cargarDatosProducto(obj[i])
            break
        }
    }

});

$('#selectProducts').change(function(e) {
    e.preventDefault();
    search = $('#selectProducts').val()

    let obj = JSON.parse(sessionStorage.getItem('prods'));

    for (let i = 0; i < obj.length; i++) {
        if (obj[i].id_producto == search) {
            $('#selectReference').val(obj[i].id_producto);
            cargarDatosProducto(obj[i])
            break
        }
    }
});

cargarDatosProducto = (obj) => {
    $('#quantity').val(1);
    obj.precio == undefined ? price = 0 : price = obj.precio
    price = parseInt(price).toLocaleString();
    quantity = $('#quantity').val();
    $('#price').val(price.toLocaleString('de-DE'));

    price = parseInt(price.replace(/[.]/gi, ''))
    price = price * quantity
    $('#totalPrice').val(price.toLocaleString());

    img = 'https://tezliksoftware.com.co/' + obj.img
    img = img.replace('../../../', '')
    $('#imgProduct').prop("src", img);
}


primeraLetraMayuscula = (string) => {
    if (string != '' && string != 0)
        cadena = string.charAt(0).toUpperCase() + string.toLowerCase().slice(1);
    return cadena
}