$.ajax({
    type: "GET",
    url: "../../../api/paymentMethods",
    success: function(response) {

        let $selectPayment = $('#selectPaymentMethods');

        $selectPayment.empty()
        $selectPayment.append(`<option disabled selected>Seleccionar</option>`)

        for (let i = 0; i < response.length; i++) {
            $selectPayment.append(`<option value = ${response[i].id_method}> ${response[i].method}</option>`)
        }
    }
});