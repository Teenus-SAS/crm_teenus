/* Load companies */

$(document).ready(function () {
  $.ajax({
    url: "/api/categories",
    success: function (dataCategories) {
      sessionStorage.setItem("categories", JSON.stringify(dataCategories));

      // Crear un objeto para almacenar las categorías únicas
      let uniqueCategories = {};

      // Filtrar y almacenar las categorías únicas en el objeto
      dataCategories.forEach((obj) => {
        const { id_category, category } = obj;
        if (!uniqueCategories[id_category]) {
          uniqueCategories[id_category] = category;
        }
      });

      const uniqueCategoryObjects = Object.entries(uniqueCategories).map(
        ([id_category, category]) => ({ id_category, category })
      );

      uniqueCategoryObjects.sort((a, b) => {
        const categoryA = a.category.toUpperCase();
        const categoryB = b.category.toUpperCase();
        if (categoryA < categoryB) {
          return -1;
        }
        if (categoryA > categoryB) {
          return 1;
        }
        return 0;
      });

      // Limpiar el select
      var $select = $("#selectCategory").empty();

      // Agregar la opción predeterminada al select
      $select.append("<option disabled selected>Categorias</option>");

      // Iterar sobre las categorías únicas y agregarlas al select
      for (let i = 0; i < uniqueCategoryObjects.length; i++) {
        $select.append(
          `<option value="${uniqueCategoryObjects[i].id_category}">${uniqueCategoryObjects[i].category}</option>`
        );
      }
    },
  });
});

/* Cargar subcategorias */

$("#selectCategory").change(function (e) {
  e.preventDefault();

  $select = $(`#selectSubcategory`);
  $select.empty();

  categories = sessionStorage.getItem("categories");
  r = JSON.parse(categories);
  category = $("#selectCategory").val();

  for (let i = 0; i < r.length; i++) {
    if (category == r[i].id_category) {
      $select.append(
        `<option option value = ${r[i].id_subcategory}> ${r[i].subcategory} </option > `
      );
    }
  }
});
