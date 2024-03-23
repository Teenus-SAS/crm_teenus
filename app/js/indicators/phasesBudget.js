$(document).ready(function () {
  /* pipeline phases */

  phasesPipeline = async (id) => {
    await $.ajax({
      type: "GET",
      url: `/api/businesscommercial`,
      success: function (data) {
        let ctx = document.getElementById("phasesPipeline").getContext("2d");

        let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        color = hexadecimal();
        $(".winValuedBusiness").css("color", color);
        gradientStroke1.addColorStop(0, color);

        let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        color = hexadecimal();
        $(".lostValuedBusiness").css("color", color);
        gradientStroke2.addColorStop(1, color);

        // Objeto para almacenar la suma de estimated_sale por sales_phase
        let salesByPhase = {};
        let labels = [];
        let values = [];

        // Iterar sobre los datos para agrupar y sumar
        data.forEach(function (item) {
          if (!salesByPhase[item.sales_phase]) {
            salesByPhase[item.sales_phase] = 0;
          }
          salesByPhase[item.sales_phase] += item.estimated_sale;
        });

        // Generar arrays para las etiquetas y valores
        for (var key in salesByPhase) {
          if (salesByPhase.hasOwnProperty(key)) {
            labels.push(key);
            values.push(salesByPhase[key]);
          }
        }

        let valuedBusiness = new Chart(ctx, {
          type: "bar",
          data: {
            labels: labels,
            datasets: [
              {
                label: "Pipeline",
                data: values,
                borderColor: gradientStroke1,
                backgroundColor: gradientStroke1,
                hoverBackgroundColor: gradientStroke1,
                pointRadius: 0,
                fill: false,
                borderWidth: 0,
              },
            ],
          },

          options: {
            maintainAspectRatio: false,
            legend: {
              position: "bottom",
              display: false,
              labels: {
                boxWidth: 8,
              },
            },
            tooltips: {
              displayColors: false,
              callbacks: {
                label: function (tooltipItem, data) {
                  return (
                    "$" +
                    Number(tooltipItem.yLabel)
                      .toFixed(0)
                      .replace(/./g, function (c, i, a) {
                        return i > 0 && c !== "." && (a.length - i) % 3 === 0
                          ? "," + c
                          : c;
                      })
                  );
                },
              },
            },
            scales: {
              yAxes: [
                {
                  ticks: {
                    callback: function (label, index, labels) {
                      return `${label / 1000000} M`;
                    },
                    min: 0,
                  },
                },
              ],
              xAxes: [
                {
                  barPercentage: 0.5,
                },
              ],
            },
          },
        });
      },
    });
  };
});
