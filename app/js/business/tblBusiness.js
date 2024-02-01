$(document).ready(function () {
  /* Cargue tabla de Proyectos */
  var groupColumn = 6;
  var groupColumnSum = 5;

  loadTblBusiness = (min_date, max_date) => {
    if (min_date == null && max_date == null) url = "/api/business";
    else url = `/api/business/${min_date}/${max_date}`;

    tableBusiness = $("#tableBusiness").DataTable({
      destroy: true,
      order: [[groupColumn, "asc"]],
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
          title: "Etapa",
          data: "sales_phase",
          className: "uniqueClassName",
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
      drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: "current" }).nodes();
        var last = null;
        var total = 0;
        var filas = api.column(groupColumnSum, { page: "current" }).data();

        filas.each( function ( group, i ) {
                
            if ( last !== group ) {
              if(last!=null){
                $(rows).eq( i - 1).after(
                    `<tr class="total"><td colspan=5>Total:</td><td>${ total }</td></tr>`
                );
                total=0;
              }
              $(rows).eq( i ).before(
                '<tr class="group"><td colspan="12">'+group+'</td></tr>'
              );

              last = group;
            }
            total+=+$(rows).eq( i ).children()[5].textContent;
            if(i==filas.length-1){
                $(rows).eq( i ).after(
                    `<tr class="total text-right"><td colspan=5>Total:</td><td>${ total }</td></tr>`
                );
            }
        });

       /*  api
          .column(groupColumn, { page: "current" })
          .data()
          .each(function (group, i) {
            if (last !== group) {
              $(rows)
                .eq(i)
                .before(
                  '<tr class="group"><td colspan="5">' + group + "</td></tr>"
                );

              last = group;
            }
          }); */
      },
    });
  };

  loadTblBusiness(null, null);
});
