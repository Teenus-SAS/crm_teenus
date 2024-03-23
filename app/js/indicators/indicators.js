/* Indicadores Generales */
indicatorsGenerales = (id) => {
  $.ajax({
    type: "GET",
    url: `/api/indicators/${id}`,
    success: function (response) {
      if (response[0].newContacts != null)
        $(".newCustomers").html(response[0].newContacts);
      else $(".newCustomers").html("0");

      if (response[1].newBusiness != null)
        $(".newBusiness").html(response[1].newBusiness);
      else $(".newBusiness").html("0");

      if (response[2].valuedBusiness != null)
        $(".valuedBusinessMonth").html(
          `$${response[2].valuedBusiness.toLocaleString().replace(/,/g, " ")}`
        );
      else $(".valuedBusinessMonth").html(`$0`);

      if (response[3].valuedBillings != null)
        $(".valuedBillsMonth").html(
          `$${response[3].valuedBillings.toLocaleString().replace(/,/g, " ")}`
        );
      else $(".valuedBillsMonth").html(`$0`);

      setTimeout(() => {
        let sum_budget = sessionStorage.getItem("sum_budget");
        let sum_bill = sessionStorage.getItem("sum_bill");
        let actual_budget = sessionStorage.getItem("actual_budget");

        !response[3].valuedBillings
          ? (valuedBillings = 0)
          : (valuedBillings = response[3].valuedBillings);

        let totalSales = (sum_bill / sum_budget) * 100;
        !isFinite(totalSales) ? (totalSales = 0) : totalSales;
        let actualSales = (actual_budget / valuedBillings) * 100;
        !isFinite(actualSales) ? (actualSales = 0) : actualSales;

        $(".totalSales").html(
          `${totalSales.toLocaleString("es-CO", {
            minimumFractionDigits: 2,
          })} % (Total)`
        );
        $(".actualSales").html(
          `${actualSales.toLocaleString("es-CO", {
            minimumFractionDigits: 2,
          })} % (Mensual)`
        );
      }, 1000);
    },
  });
};

/* Presupuesto */

budgetGeneral = async (id) => {
  await $.ajax({
    type: "GET",
    url: `/api/budgetsvsOrders/${id}`,
    success: function (resp) {
      sessionStorage.setItem("total_pagado", resp[resp.length - 1].won);
      resp.pop();

      let ctx = document.getElementById("budgetsvsorders").getContext("2d");

      let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      color = hexadecimal();
      $(".colorBudgets").css("color", color);
      gradientStroke1.addColorStop(0, color);

      let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      color = hexadecimal();
      $(".colorOrders").css("color", color);
      gradientStroke2.addColorStop(0, color);

      budget = [];
      orders = [];
      var fechaActual = new Date();

      var numeroMes = fechaActual.getMonth();

      var nombresMeses = [
        "enero",
        "febrero",
        "marzo",
        "abril",
        "mayo",
        "junio",
        "julio",
        "agosto",
        "septiembre",
        "octubre",
        "noviembre",
        "diciembre",
      ];

      var nombreMes = nombresMeses[numeroMes];
      let sum_budget =
        resp[0].enero +
        resp[0].febrero +
        resp[0].marzo +
        resp[0].abril +
        resp[0].mayo +
        resp[0].junio +
        resp[0].julio +
        resp[0].agosto +
        resp[0].septiembre +
        resp[0].octubre +
        resp[0].noviembre +
        resp[0].diciembre;
      sessionStorage.setItem("sum_budget", sum_budget);
      sessionStorage.setItem("actual_budget", resp[0][nombreMes]);
      let sum_bill = 0;

      budget.push(resp[0].enero);
      budget.push(resp[0].febrero);
      budget.push(resp[0].marzo);
      budget.push(resp[0].abril);
      budget.push(resp[0].mayo);
      budget.push(resp[0].junio);
      budget.push(resp[0].julio);
      budget.push(resp[0].agosto);
      budget.push(resp[0].septiembre);
      budget.push(resp[0].octubre);
      budget.push(resp[0].noviembre);
      budget.push(resp[0].diciembre);

      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);
      orders.push(0);

      for (let i = 1; i < resp.length; i++) {
        sum_bill += resp[i].won;
        if (resp[i].month == "January") orders[0] = resp[i].won;
        else if (resp[i].month == "February") orders[1] = resp[i].won;
        else if (resp[i].month == "March") orders[2] = resp[i].won;
        else if (resp[i].month == "April") orders[3] = resp[i].won;
        else if (resp[i].month == "May") orders[4] = resp[i].won;
        else if (resp[i].month == "June") orders[5] = resp[i].won;
        else if (resp[i].month == "July") orders[6] = resp[i].won;
        else if (resp[i].month == "August") orders[7] = resp[i].won;
        else if (resp[i].month == "September") orders[8] = resp[i].won;
        else if (resp[i].month == "October") orders[9] = resp[i].won;
        else if (resp[i].month == "November") orders[10] = resp[i].won;
        else if (resp[i].month == "December") orders[11] = resp[i].won;
      }
      sessionStorage.setItem("sum_bill", sum_bill);

      let BudgetvsOrders = new Chart(ctx, {
        type: "bar",
        data: {
          labels: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
          ],

          datasets: [
            {
              label: "Presupuesto Ventas",
              data: budget,
              borderColor: gradientStroke1,
              backgroundColor: gradientStroke1,
              hoverBackgroundColor: gradientStroke1,
              //pointRadius: 0,
              fill: false,
              borderWidth: 0,
              //stack: 'combined',
              type: "line",
            },
            {
              label: "Facturacion",
              data: orders,
              borderColor: gradientStroke2,
              backgroundColor: gradientStroke2,
              hoverBackgroundColor: gradientStroke2,
              //pointRadius: 0,
              fill: false,
              borderWidth: 0,
              stack: "combined",
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

//Meta Facturacion

(goalBilling = () => {
  let ctx = document.getElementById("goalBilling").getContext("2d");

  let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

  let colors = [];

  color = hexadecimal();
  $(".colorGoal").css("color", color);
  gradientStroke1.addColorStop(0, color);

  let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);

  color = hexadecimal();
  $(".colorBill").css("color", color);
  gradientStroke2.addColorStop(0, color);

  colors.push(gradientStroke1, gradientStroke2);

  let sum = [];
  sum.push(sessionStorage.getItem("sum_budget"));
  sum.push(sessionStorage.getItem("sum_bill"));
  sum.push(sessionStorage.getItem("total_pagado"));

  var quantityCustomers = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Meta", "Facturacion", "Pagados"],
      datasets: [
        {
          data: sum,
          borderColor: colors,
          backgroundColor: colors,
          hoverBackgroundColor: colors,
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
              "" +
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
}),
  /* Clientes Nuevos */

  (newCustomers = (id) => {
    $.ajax({
      type: "GET",
      url: `/api/quantityCustomers/${id}`,
      success: function (resp) {
        let ctx = document.getElementById("quantityCustomers").getContext("2d");

        let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

        color = hexadecimal();
        $(".newCustomersMonth").css("color", color);
        gradientStroke1.addColorStop(0, color);

        month = [];
        quantity = [];
        //debugger
        for (let i = 0; i < resp.length; i++) {
          month.push(resp[i].MonthName);
          quantity.push(resp[i].Quantity);
        }
        //debugger
        var quantityCustomers = new Chart(ctx, {
          type: "bar",
          data: {
            labels: month,
            datasets: [
              {
                label: "Clientes",
                data: quantity,
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
                    "" +
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
  });

/* Proyectos nuevos */
newBusiness = (id) => {
  $.ajax({
    type: "GET",
    url: `/api/newBusiness/${id}`,
    success: function (resp) {
      let ctx = document.getElementById("newBusiness").getContext("2d");

      let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

      color = hexadecimal();
      $(".newBusiness2").css("color", color);
      gradientStroke1.addColorStop(0, color);

      month = [];
      quantity = [];
      //debugger
      for (let i = 0; i < resp.length; i++) {
        month.push(resp[i].MonthName);
        quantity.push(resp[i].Quantity);
      }
      //debugger
      var newBusiness = new Chart(ctx, {
        type: "bar",
        data: {
          labels: month,
          datasets: [
            {
              label: "Proyectos",
              data: quantity,
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
                  "" +
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
/* Proyectos Ganados y Perdidos */
winLoseProjects = (id) => {
  $.ajax({
    type: "GET",
    url: `/api/quantityBusiness/${id}`,
    success: function (resp) {
      let ctx = document.getElementById("quantityBusiness").getContext("2d");

      let gradientStroke1 = ctx.createLinearGradient(0, 20, 0, 300);
      color = hexadecimal();
      gradientStroke1.addColorStop(1, color);
      $(".winBusiness").css("color", color);

      let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      color = hexadecimal();
      $(".lostBusiness").css("color", color);
      gradientStroke2.addColorStop(1, color);

      month = [];
      quantitywon = [];
      quantityfail = [];

      for (let i = 0; i < resp.length; i++) {
        if (resp[i].month != month[i - 1]) month.push(resp[i].month);
        if (resp[i].won != undefined) quantitywon.push(resp[i].won);
        if (resp[i].fail != undefined) quantityfail.push(resp[i].fail);
      }

      let myCquantityBusinesshart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: month,
          datasets: [
            {
              label: "Proyectos Ganados",
              data: quantitywon,
              borderColor: gradientStroke1,
              backgroundColor: gradientStroke1,
              hoverBackgroundColor: gradientStroke1,
              pointRadius: 0,
              fill: false,
              borderWidth: 0,
            },
            {
              label: "Proyectos Perdidos",
              data: quantityfail,
              borderColor: gradientStroke2,
              backgroundColor: gradientStroke2,
              hoverBackgroundColor: gradientStroke2,
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
              boxWidth: 0,
            },
          },
          tooltips: {
            displayColors: false,
            callbacks: {
              label: function (tooltipItem, data) {
                return (
                  "" +
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

/* Valoracion Proyectos Ganados y Perdidos */
valuedProjects = (id) => {
  $.ajax({
    type: "GET",
    url: `/api/valuedBusiness/${id}`,
    success: function (resp) {
      let ctx = document.getElementById("valuedBusiness").getContext("2d");

      let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      color = hexadecimal();
      $(".winValuedBusiness").css("color", color);
      gradientStroke1.addColorStop(0, color);

      let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      color = hexadecimal();
      $(".lostValuedBusiness").css("color", color);
      gradientStroke2.addColorStop(1, color);

      month = [];
      valuedwon = [];
      valuedfail = [];

      for (let i = 0; i < resp.length; i++) {
        if (resp[i].month != month[i - 1]) month.push(resp[i].month);
        if (resp[i].won != undefined) valuedwon.push(resp[i].won);
        if (resp[i].fail != undefined) valuedfail.push(resp[i].fail);
      }

      let valuedBusiness = new Chart(ctx, {
        type: "bar",
        data: {
          labels: month,
          datasets: [
            {
              label: "Proyectos Ganados",
              data: valuedwon,
              borderColor: gradientStroke1,
              backgroundColor: gradientStroke1,
              hoverBackgroundColor: gradientStroke1,
              pointRadius: 0,
              fill: false,
              borderWidth: 0,
            },
            {
              label: "Proyectos Perdidos",
              data: valuedfail,
              borderColor: gradientStroke2,
              backgroundColor: gradientStroke2,
              hoverBackgroundColor: gradientStroke2,
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

/* Valoracion Pedidos Ganados y Perdidos */
valuedOrders = (id) => {
  $.ajax({
    type: "GET",
    url: `/api/valuedOrders/${id}`,
    success: function (resp) {
      let ctx = document.getElementById("valuedOrders").getContext("2d");

      let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

      color = hexadecimal();
      $(".valuedOrdersInd").css("color", color);
      gradientStroke1.addColorStop(0, color);

      month = [];
      valuedorders = [];

      for (let i = 0; i < resp.length; i++) {
        month.push(resp[i].month);
        valuedorders.push(resp[i].won);
      }

      let valuedBusiness = new Chart(ctx, {
        type: "bar",
        data: {
          labels: month,
          datasets: [
            {
              label: "Facturacion",
              data: valuedorders,
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

hexadecimal = () => {
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  color = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
  return color;
};

fetchdata = async () => {
  await budgetGeneral(1);
  indicatorsGenerales(1);
  phasesPipeline(1);
  goalBilling(1);
  newCustomers(1);
  newBusiness(1);
  winLoseProjects(1);
  valuedProjects(1);
  valuedOrders(1);
};
fetchdata();

$("#selectSeller").change(async function (e) {
  e.preventDefault();
  id = $("#selectSeller").val();

  await budgetGeneral(id);
  indicatorsGenerales(id);
  goalBilling(id);
  newCustomers(id);
  newBusiness(id);
  winLoseProjects(id);
  valuedProjects(id);
  valuedOrders(id);
});
