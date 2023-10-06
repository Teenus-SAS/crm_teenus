/* Cargue tabla de usuarios */

$(document).ready(function() {
  phases = [];

    $.ajax({
        url: '/api/salesPhases',
        success: function(r) {
            for (let i = 0; i < r.length; i++) {
                $(`#board_business`).append(`
                    <div class="col-4 col-lg-4 mb-3" style="text-align:center">
                    <label class="mb-2 etapa${r[i].id_phase}" style="color:#8DAC18">Total Etapa:</label>
                      <div class="card bg-light mb-3">
                        <div class="card-header">${r[i].sales_phase}</div>
                        <div class="card-body" id="etapa${r[i].id_phase}"></div>
                      </div>
                  </div>`) 
              phases[`${r[i].id_phase}`] = 0;
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

          $(`#etapa${respBusiness[i].id_phase}`).append(`<div class="card" style="margin-bottom:10px">
                      <div class="card-body">
                        <b style="color:#8DAC18">${respBusiness[i].name_business}</b><br>
                        <b style="color:#8DAC18">${respBusiness[i].company}</b><br>
                        Valor: $ ${valor}<br>
                      </div>
                    </div>`);
          let valorEtapa = phases[respBusiness[i].id_phase];

          valorEtapa = valorEtapa + respBusiness[i].estimated_sale;
          phases[respBusiness[i].id_phase] = valorEtapa;
            etapaClienteNuevo = valorEtapa.toLocaleString('es', noTruncarDecimales)
            $(`.etapa${respBusiness[i].id_phase}`).html(`<b>Total: $${etapaClienteNuevo}</b>`);
        }
    }



})