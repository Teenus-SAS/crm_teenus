$(document).ready(function() {
    /* Cargue tabla de usuarios */
    tableBudgets = $('#tableBudgets').dataTable({
        pageLength: 10,
        ajax: {
            url: '/api/budgets',
            dataSrc: '',
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
        },
        columns: [{
                title: 'No.',
                data: null,
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: 'Asesor Comercial',
                data: 'comercial',
                className: 'uniqueClassName',
            },
            {
                title: 'Enero',
                data: 'jan',
                type: 'numeric',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Febrero',
                data: 'feb',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Marzo',
                data: 'mar',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Abril',
                data: 'apr',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Mayo',
                data: 'may',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Junio',
                data: 'june',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Julio',
                data: 'july',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Agosto',
                data: 'aug',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Septiembre',
                data: 'sept',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Octubre',
                data: 'oct',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Noviembre',
                data: 'nov',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },
            {
                title: 'Diciembre',
                data: 'decem',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0),
            },

            {
                title: 'Acciones',
                data: 'id_budget',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                <a href="javascript:;" id=${data} <i class="bx bx-edit-alt updateBudget" data-toggle='tooltip' title='Actualizar Presupuesto' style="font-size: 35px;"></i></a>`;
                },
            },
        ],

        footerCallback: function(row, data, start, end, display) {
            var api = this.api(),
                data;

            // converting to interger to find total
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i :
                    0;
            };

            // computing column Total of the complete result
            var janTotal = api
                .column(2)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var febTotal = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var marTotal = api
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var aprTotal = api
                .column(5)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var mayTotal = api
                .column(6)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var junTotal = api
                .column(7)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var julTotal = api
                .column(8)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var agoTotal = api
                .column(9)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var sepTotal = api
                .column(10)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var octTotal = api
                .column(11)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var novTotal = api
                .column(12)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            var dicTotal = api
                .column(13)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer by showing the total with the reference of the column index
            $(api.column(0).footer()).html('Total');
            $(api.column(2).footer()).html(janTotal.toLocaleString('en-US'));
            $(api.column(3).footer()).html(febTotal.toLocaleString('en-US'));
            $(api.column(4).footer()).html(marTotal.toLocaleString('en-US'));
            $(api.column(5).footer()).html(aprTotal.toLocaleString('en-US'));
            $(api.column(6).footer()).html(mayTotal.toLocaleString('en-US'));
            $(api.column(7).footer()).html(junTotal.toLocaleString('en-US'));
            $(api.column(8).footer()).html(julTotal.toLocaleString('en-US'));
            $(api.column(9).footer()).html(agoTotal.toLocaleString('en-US'));
            $(api.column(10).footer()).html(sepTotal.toLocaleString('en-US'));
            $(api.column(11).footer()).html(octTotal.toLocaleString('en-US'));
            $(api.column(12).footer()).html(novTotal.toLocaleString('en-US'));
            $(api.column(13).footer()).html(dicTotal.toLocaleString('en-US'));
        },
    });

    $('#january').keyup(function(e) {
        value = this.value;
        number = value.toLocaleString('en-US', { maximumFractionDigits: 2 });
        $('#january').val(number);
    });

    /* Creacion Nuevo Usuario */
    $('#btnCreateBudget').click(function(e) {
        e.preventDefault();

        let data = $('#formBudgetSeller').serialize();

        $.ajax({
            type: 'POST',
            url: `/api/addBudget`,
            data: data,
            success: function(response, jqXHR, statusCode) {
                if (response.error == true) toastr.error(response.message);

                if (response.success == true) {
                    $('#modalCreateBudgets').modal('hide');
                    $('#formBudgetSeller')[0].reset();
                    updateTable();
                    toastr.success(response.message);
                }
            },
        });
    });

    /* Actualizacion Usuario */

    $(document).on('click', '.updateBudget', function(e) {
        e.preventDefault();
        let row = $(this).parent().parent()[0];
        let data = tableBudgets.DataTable().row(row).data();

        $('#modalCreateBudgets').modal('show');
        $('#btnCreateBudget').html('Actualizar Presupuesto');

        $(`.selectSeller option:contains(${data.comercial})`).prop(
            'selected',
            true
        );
        $('#year').val(data.year);
        $('#jan').val(data.jan);
        $('#feb').val(data.feb);
        $('#mar').val(data.mar);
        $('#apr').val(data.apr);
        $('#may').val(data.may);
        $('#june').val(data.june);
        $('#july').val(data.july);
        $('#aug').val(data.aug);
        $('#sept').val(data.sept);
        $('#oct').val(data.oct);
        $('#nov').val(data.nov);
        $('#decem').val(data.decem);
    });

    /* Actualizar tabla */

    function updateTable() {
        $('#tableBudgets').DataTable().clear();
        $('#tableBudgets').DataTable().ajax.reload();
    }
});