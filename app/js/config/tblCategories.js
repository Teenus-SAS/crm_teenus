$(document).ready(function () {
  /* Cargue tabla de Categorias */
  tableCategories = $("#tableCategories").dataTable({
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
      { width: "10px", targets: [0] },
      { width: "200px", targets: [1] },
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
      /*  {
        title: "Categorias",
        data: "category",
        className: "uniqueClassName",
      }, */
      {
        title: "Subcategorias",
        data: "subcategory",
        className: "uniqueClassName",
      },

      /* {
        title: "Acciones",
        data: "id_category",
        render: function (data) {
          return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateCategory" data-toggle='tooltip' title='Editar Categoria' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="bx bx-trash deleteCategory" data-toggle='tooltip' title='Eliminar Categoria' style="font-size: 35px;color:red"></i></a>`;
        },
      }, */
    ],
    rowGroup: {
      dataSrc: "category",
    },
  });
});
