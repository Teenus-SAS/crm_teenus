$(document).ready(function () {
  /* Cargue tabla de SubCategorias */

  tableSubCategories = $("#tableSubCategories").dataTable({
    pageLength: 50,
    autoWidth: false,
    ajax: {
      url: "/api/categories",
      dataSrc: "",
    },
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    columnDefs: [
      { width: "5px", targets: [0, 3] },
      { width: "2000px", targets: [1, 2] },
    ],
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
        title: "Categorias",
        data: "category",
        className: "uniqueClassName",
      },
      {
        title: "Subcategorias",
        data: "subcategory",
        className: "uniqueClassName",
      },
      {
        title: "Acciones",
        data: "id_category",
        render: function (data) {
          return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateSubcategory" data-toggle='tooltip' title='Editar Fase de Venta' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="deleteUser" data-toggle='tooltip' title='Eliminar Fase de Venta' style="font-size: 35px;color:red"></i></a>`;
        },
      },
    ],
  });
});
