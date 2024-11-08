$(document).ready(function () {
  /* Cargue tabla de Categorias */

  tableCategoriesUnique = $("#tableCategoriesUnique").dataTable({
    pageLength: 50,
    autoWidth: false,
    ajax: {
      url: "/api/categoriesUnique",
      dataSrc: "",
    },
    language: {
      url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json',
    },
    columnDefs: [
      { width: "5px", targets: [0, 2] },
      { width: "2000px", targets: [1] },
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
        title: "Acciones",
        data: "id_category",
        render: function (data) {
          return `
                <a href="javascript:;" id="${data}" <i class="bx bx-edit-alt updateCategory" data-toggle='tooltip' title='Editar Categoria' style="font-size: 35px;"></i></a> 
                <a href="javascript:;" id="${data}" <i class="deleteCategory" data-toggle='tooltip' title='Eliminar Categoria' style="font-size: 35px;color:red"></i></a>`;
        },
      },
    ],
  });
});
