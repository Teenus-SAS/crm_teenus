$(document).ready(function () {
  /* Cargue tabla de Proyectos */
  loadTblBusiness = (min_date, max_date) => {
    if (min_date == null && max_date == null) url = "/api/business";
    else url = `/api/business/${min_date}/${max_date}`;

    tableBusiness = $("#tableBusiness").DataTable({
      destroy: true,
      pageLength: 50,
      ajax: {
        url: url,
        dataSrc: "",
      },
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      columns: [
        {
          title: "No.",
          data: null,
          className: "uniqueClassName",
          render: function (data, type, full, meta) {
            return meta.row + 1;
          },
        },
        {
          title: "Fecha Creación",
          data: "date_register",
          className: "uniqueClassName",
        },
        {
          title: "Empresa",
          data: "company",
          className: "uniqueClassName",
        },
        {
          title: "Contacto",
          data: "contact",
          className: "uniqueClassName",
        },
        {
          title: "Proyecto",
          data: "name_business",
          className: "uniqueClassName",
          render: function (data, type, full, meta) {
            return "<div class='text-wrap width-350'>" + data + "</div>";
          },
        },
        {
          title: "Venta Estimada",
          data: "estimated_sale",
          className: "uniqueClassName",
          render: $.fn.dataTable.render.number(".", ",", 0, "$ "),
        },
        /* {
                    title: 'Etapa',
                    data: 'sales_phase',
                    className: 'uniqueClassName',
                }, */
        /* {
                    title: '%',
                    data: 'percent',
                    className: 'uniqueClassName',
                    render: (data, type, row) => {
                        return `${(data * 100).toFixed(0).replace('.', ',')}%`;
                    },
                }, */

        /* {
                    title: 'Plazo',
                    data: 'term',
                    render: (data, type, row) => {
                        return data == 1 ? 'Corto' : data == 2 ? 'Mediano' : 'Largo';
                    },
                }, */
        /* {
                title: 'Observaciones',
                data: 'observation',
                className: 'uniqueClassName',
                render: function (data, type, full, meta) {
                    return "<div class='text-wrap width-350'>" + data + '</div>';
                },
                }, */
        {
          title: "Asesor Comercial",
          data: "seller",
          visible: tipo !== "2",
          className: "uniqueClassName",
        },
        {
          title: "Acciones",
          data: "id_business",
          visible: tipo !== "1",
          className: "uniqueClassName",
          render: function (data) {
            return `<a href="javascript:;" <i id="${data}"" class="bx bx-edit-alt updateBusiness" data-toggle='tooltip' title='Actualizar Proyectos' style="font-size: 35px;"></i></a>
                                <a href="javascript:;" <i id="${data}"" class="bx bx-check-double winBusiness" data-toggle='tooltip' title='Proyecto Ganado' style="font-size: 35px;color:green"></i></a>`;
          },
        },
      ],
      order: [[5, "asc"]], // Ordenar por la columna de 'Etapa'
      rowGroup: {
        dataSrc: "sales_phase", // Columna por la que se agruparán los registros
        className: 'group-header',
        startRender: null, // Opciones adicionales para personalizar el inicio del grupo
        endRender: function (rows, group) {
          return $("<tr/>").append(
            '<td colspan="6"><b>Etapa: ' + group + "</b></td>"
          );
        },
      },
    });
  };

  loadTblBusiness(null, null);
});
