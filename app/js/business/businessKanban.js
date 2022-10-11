/* Cargue tabla de usuarios */

$(document).ready(function() {

    let valorEtapa1 = 0,
        valorEtapa2 = 0,
        valorEtapa3 = 0,
        valorEtapa4 = 0,
        valorEtapa5 = 0,
        valorEtapa6 = 0,
        valorEtapa7 = 0

    $.ajax({
        url: '/api/salesPhases',
        success: function(r) {
            for (let i = 0; i < r.length; i++) {
                $(`#board_business`).append(`
                    <div class="" style="text-align:center">
                    <label class="mb-2 etapa${i + 1}" style="color:#8DAC18">Total Etapa:</label>
                      <div class="card bg-light mb-3" style="width:250px">
                        <div class="card-header">${r[i].sales_phase}</div>
                        <div class="card-body" id="etapa${r[i].id_phase}"></div>
                      </div>
                  </div>`)
            }
            business()
        },
    })

    /* Load all business */

    const business = () => {

        $.ajax({
            url: '/api/business',
            success: function(respBusiness) {
                loadPhases(respBusiness)
            },
        })
    }


    /* load commercial's business */

    $(document).on('change', '#selectSellerKanban', function(e) {
        e.preventDefault();

        valorEtapa1 = 0
        valorEtapa2 = 0
        valorEtapa3 = 0
        valorEtapa4 = 0
        valorEtapa5 = 0
        valorEtapa6 = 0
        valorEtapa7 = 0

        for (let i = 0; i < 8; i++) {
            $(`#etapa${i}`).empty()
            $(`.etapa${i}`).html(`<b>Total: $0.00</b>`);
        }

        seller = $(".selectSellerKanban option:selected").val();
        if (seller == 0)
            business();
        else {
            $.ajax({
                type: "GET",
                url: `/api/business/${seller}`,
                success: function(respBusiness) {
                    loadPhases(respBusiness)
                },
            })
        }

    });


    /* Create cards */

    const loadPhases = (respBusiness) => {
        const noTruncarDecimales = { maximumFractionDigits: 20 }

        for (let i = 0; i < respBusiness.length; i++) {
            valor = respBusiness[i].estimated_sale.toLocaleString('es', noTruncarDecimales)

            if (respBusiness[i].id_phase == 1) {
                $(`#etapa1`).append(`<div class="card" style="margin-bottom:10px">
                          <div class="card-body">
                            <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                            Valor: $ ${valor}<br>
                          </div>
                        </div>`)
                valorEtapa1 = valorEtapa1 + respBusiness[i].estimated_sale
                etapaClienteNuevo = valorEtapa1.toLocaleString('es', noTruncarDecimales)
                $('.etapa1').html(`<b>Total: $${etapaClienteNuevo}</b>`);
            }

            if (respBusiness[i].id_phase == 2) {
                $(`#etapa2`).append(`<div class="card" style="margin-bottom:10px">
                            <div class="card-body">
                              <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                              Valor: $ ${valor}<br>
                            </div>
                          </div>`)
                valorEtapa2 = valorEtapa2 + respBusiness[i].estimated_sale
                etapaPropuesta = valorEtapa2.toLocaleString('es', noTruncarDecimales)
                $('.etapa2').html(`<b>Total: $${etapaPropuesta}</b>`);
            }

            if (respBusiness[i].id_phase == 3) {
                $(`#etapa3`).append(`<div class="card" style="margin-bottom:10px">
                            <div class="card-body">
                              <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                              Valor: $ ${valor}<br>
                            </div>
                          </div>`)
                valorEtapa3 = valorEtapa3 + respBusiness[i].estimated_sale
                etapaNegociación = valorEtapa3.toLocaleString('es', noTruncarDecimales)
                $('.etapa3').html(`<b>Total: $${etapaNegociación}</b>`);
            }

            if (respBusiness[i].id_phase == 4) {
                $(`#etapa4`).append(`<div class="card" style="margin-bottom:10px">
                          <div class="card-body">
                            <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                            Valor: $ ${valor}<br>
                          </div>
                        </div>`)
                valorEtapa4 = valorEtapa4 + respBusiness[i].estimated_sale
                etapaRevision = valorEtapa4.toLocaleString('es', noTruncarDecimales)
                $('.etapa4').html(`<b>Total: $${etapaRevision}</b>`);
            }

            if (respBusiness[i].id_phase == 5) {
                $(`#etapa5`).append(`<div class="card" style="margin-bottom:10px">
                            <div class="card-body">
                              <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                              Valor: $ ${valor}<br>
                            </div>
                          </div>`)
                valorEtapa5 = valorEtapa5 + respBusiness[i].estimated_sale
                etapaPospuesta = valorEtapa5.toLocaleString('es', noTruncarDecimales)
                $('.etapa5').html(`<b>Total: $${etapaPospuesta}</b>`);
            }

            if (respBusiness[i].id_phase == 6) {
                $(`#etapa6`).append(`<div class="card" style="margin-bottom:10px">
                            <div class="card-body">
                              <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                              Valor: $ ${valor}<br>
                            </div>
                          </div>`)
                valorEtapa6 = valorEtapa6 + respBusiness[i].estimated_sale
                etapaGanada = valorEtapa6.toLocaleString('es', noTruncarDecimales)
                $('.etapa6').html(`<b>Total: $${etapaGanada}</b>`);
            }

            if (respBusiness[i].id_phase == 7) {
                $(`#etapa7`).append(`<div class="card" style="margin-bottom:10px">
                            <div class="card-body">
                              <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                              Valor: $ ${valor}<br>
                            </div>
                          </div>`)
                valorEtapa7 = valorEtapa7 + respBusiness[i].estimated_sale
                etapaGanada = valorEtapa7.toLocaleString('es', noTruncarDecimales)
                $('.etapa7').html(`<b>Total: $${etapaGanada}</b>`);
            }
        }
    }



})