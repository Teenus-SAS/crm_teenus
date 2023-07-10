/* Indicadores Generales */
indicatorsGenerales = (id) => {
    $.ajax({
        type: 'GET',
        url: `/api/indicators/${id}`,
        success: function(response) {
            if (response[0].newContacts != null)
                $('.newCustomers').html(response[0].newContacts);
            else $('.newCustomers').html('0');

            if (response[1].newBusiness != null)
                $('.newBusiness').html(response[1].newBusiness);
            else $('.newBusiness').html('0');

            if (response[2].valuedBusiness != null)
                $('.valuedBusinessMonth').html(
                    `$${response[2].valuedBusiness.toLocaleString().replace(/,/g, ' ')}`
                );
            else $('.valuedBusinessMonth').html(`$0`);

            if (response[3].valuedOrders != null) {
                $('.valuedOrdersMonth').html(`$${response[3].valuedOrders.toLocaleString().replace(/,/g, ' ')}`);
                $('.valuedOrdersAnnual').html(`$${(response[3].valuedOrders * 12).toLocaleString().replace(/,/g, ' ')}`);
            }
            else { 
                $('.valuedOrdersMonth').html(`$0`);
                $('.valuedOrdersAnnual').html(`$0`);
            }
        },
    });
};

/* Presupuesto */

budgetGeneral = (id) => {
    $.ajax({
        type: 'GET',
        url: `/api/budgetsvsOrders/${id}`,
        success: function(resp) {
            let ctx = document.getElementById('budgetsvsorders').getContext('2d');

            let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            color = hexadecimal();
            $('.colorBudgets').css('color', color);
            gradientStroke1.addColorStop(0, color);

            let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            color = hexadecimal();
            $('.colorOrders').css('color', color);
            gradientStroke2.addColorStop(0, color);

            budget = [];
            orders = [];

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

            for (let i = 1; i < resp.length; i++) {
                if (resp[i].month == 'January') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'February') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'March') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'April') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'May') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'June') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'July') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'Aguost') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'September') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'October') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'November') orders.push(resp[i].won);
                else orders.push(0);
                if (resp[i].month == 'December') orders.push(resp[i].won);
                else orders.push(0);
            }

            let BudgetvsOrders = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre',
                    ],

                    datasets: [{
                            label: 'Presupuesto Ventas',
                            data: budget,
                            borderColor: gradientStroke1,
                            backgroundColor: gradientStroke1,
                            hoverBackgroundColor: gradientStroke1,
                            //pointRadius: 0,
                            fill: false,
                            borderWidth: 0,
                            //stack: 'combined',
                            type: 'line',
                        },
                        {
                            label: 'Pedidos',
                            data: orders,
                            borderColor: gradientStroke2,
                            backgroundColor: gradientStroke2,
                            hoverBackgroundColor: gradientStroke2,
                            //pointRadius: 0,
                            fill: false,
                            borderWidth: 0,
                            stack: 'combined',
                        },
                    ],
                },

                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8,
                        },
                    },
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return (
                                    '$' +
                                    Number(tooltipItem.yLabel)
                                    .toFixed(0)
                                    .replace(/./g, function(c, i, a) {
                                        return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                            ',' + c :
                                            c;
                                    })
                                );
                            },
                        },
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return `${label / 1000000} M`;
                                },
                                min: 0,
                            },
                        }, ],
                        xAxes: [{
                            barPercentage: 0.5,
                        }, ],
                    },
                },
            });
        },
    });
};

//Meta Facturacion

goalBilling = (id) => {
        let ctx = document.getElementById('quantityCustomers').getContext('2d');

        let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

        color = hexadecimal();
        $('.newCustomersMonth').css('color', color);
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
            type: 'bar',
            data: {
                labels: month,
                datasets: [{
                    label: 'Clientes',
                    data: quantity,
                    borderColor: gradientStroke1,
                    backgroundColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 0,
                }, ],
            },

            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    display: false,
                    labels: {
                        boxWidth: 8,
                    },
                },
                tooltips: {
                    displayColors: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return (
                                '' +
                                Number(tooltipItem.yLabel)
                                .toFixed(0)
                                .replace(/./g, function(c, i, a) {
                                    return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                        ',' + c :
                                        c;
                                })
                            );
                        },
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        },
                    }, ],
                    xAxes: [{
                        barPercentage: 0.5,
                    }, ],
                },
            },
        });
    },

    /* Clientes Nuevos */

    newCustomers = (id) => {
        $.ajax({
            type: 'GET',
            url: `/api/quantityCustomers/${id}`,
            success: function(resp) {
                let ctx = document.getElementById('quantityCustomers').getContext('2d');

                let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

                color = hexadecimal();
                $('.newCustomersMonth').css('color', color);
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
                    type: 'bar',
                    data: {
                        labels: month,
                        datasets: [{
                            label: 'Clientes',
                            data: quantity,
                            borderColor: gradientStroke1,
                            backgroundColor: gradientStroke1,
                            hoverBackgroundColor: gradientStroke1,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 0,
                        }, ],
                    },

                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            display: false,
                            labels: {
                                boxWidth: 8,
                            },
                        },
                        tooltips: {
                            displayColors: false,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return (
                                        '' +
                                        Number(tooltipItem.yLabel)
                                        .toFixed(0)
                                        .replace(/./g, function(c, i, a) {
                                            return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                                ',' + c :
                                                c;
                                        })
                                    );
                                },
                            },
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                },
                            }, ],
                            xAxes: [{
                                barPercentage: 0.5,
                            }, ],
                        },
                    },
                });
            },
        });
    };
/* Proyectos Ganados y Perdidos */
winLoseProjects = (id) => {
    $.ajax({
        type: 'GET',
        url: `/api/quantityBusiness/${id}`,
        success: function(resp) {
            let ctx = document.getElementById('quantityBusiness').getContext('2d');

            let gradientStroke1 = ctx.createLinearGradient(0, 20, 0, 300);
            color = hexadecimal();
            gradientStroke1.addColorStop(1, color);
            $('.winBusiness').css('color', color);

            let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            color = hexadecimal();
            $('.lostBusiness').css('color', color);
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
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                            label: 'Proyectos Ganados',
                            data: quantitywon,
                            borderColor: gradientStroke1,
                            backgroundColor: gradientStroke1,
                            hoverBackgroundColor: gradientStroke1,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 0,
                        },
                        {
                            label: 'Proyectos Perdidos',
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
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 0,
                        },
                    },
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return (
                                    '' +
                                    Number(tooltipItem.yLabel)
                                    .toFixed(0)
                                    .replace(/./g, function(c, i, a) {
                                        return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                            ',' + c :
                                            c;
                                    })
                                );
                            },
                        },
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            },
                        }, ],
                        xAxes: [{
                            barPercentage: 0.5,
                        }, ],
                    },
                },
            });
        },
    });
};

/* Valoracion Proyectos Ganados y Perdidos */
valuedProjects = (id) => {
    $.ajax({
        type: 'GET',
        url: `/api/valuedBusiness/${id}`,
        success: function(resp) {
            let ctx = document.getElementById('valuedBusiness').getContext('2d');

            let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            color = hexadecimal();
            $('.winValuedBusiness').css('color', color);
            gradientStroke1.addColorStop(0, color);

            let gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            color = hexadecimal();
            $('.lostValuedBusiness').css('color', color);
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
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                            label: 'Proyectos Ganados',
                            data: valuedwon,
                            borderColor: gradientStroke1,
                            backgroundColor: gradientStroke1,
                            hoverBackgroundColor: gradientStroke1,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 0,
                        },
                        {
                            label: 'Proyectos Perdidos',
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
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8,
                        },
                    },
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return (
                                    '$' +
                                    Number(tooltipItem.yLabel)
                                    .toFixed(0)
                                    .replace(/./g, function(c, i, a) {
                                        return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                            ',' + c :
                                            c;
                                    })
                                );
                            },
                        },
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return `${label / 1000000} M`;
                                },
                                min: 0,
                            },
                        }, ],
                        xAxes: [{
                            barPercentage: 0.5,
                        }, ],
                    },
                },
            });
        },
    });
};

/* Valoracion Pedidos Ganados y Perdidos */
valuedOrders = (id) => {
    $.ajax({
        type: 'GET',
        url: `/api/valuedOrders/${id}`,
        success: function(resp) {
            let ctx = document.getElementById('valuedOrders').getContext('2d');

            let gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);

            color = hexadecimal();
            $('.valuedOrdersInd').css('color', color);
            gradientStroke1.addColorStop(0, color);

            month = [];
            valuedorders = [];

            for (let i = 0; i < resp.length; i++) {
                month.push(resp[i].month);
                valuedorders.push(resp[i].won);
            }

            let valuedBusiness = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                        label: 'Pedidos',
                        data: valuedorders,
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 0,
                    }, ],
                },

                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8,
                        },
                    },
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return (
                                    '$' +
                                    Number(tooltipItem.yLabel)
                                    .toFixed(0)
                                    .replace(/./g, function(c, i, a) {
                                        return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ?
                                            ',' + c :
                                            c;
                                    })
                                );
                            },
                        },
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return `${label / 1000000} M`;
                                },
                                min: 0,
                            },
                        }, ],
                        xAxes: [{
                            barPercentage: 0.5,
                        }, ],
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
    color = '#' + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    return color;
};

budgetGeneral(1);
indicatorsGenerales(1);
// goalBilling(1);
newCustomers(1);
winLoseProjects(1);
valuedProjects(1);
valuedOrders(1);

$('#selectSeller').change(function(e) {
    e.preventDefault();
    id = $('#selectSeller').val();

    budgetGeneral(id);
    indicatorsGenerales(id);
    // goalBilling(id);
    newCustomers(id);
    winLoseProjects(id);
    valuedProjects(id);
    valuedOrders(id);
});