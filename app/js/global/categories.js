/* Load companies */

$(document).ready(function () {
  $.ajax({
    url: "/api/categories",
    success: function (r) {
      sessionStorage.setItem("categories", JSON.stringify(r));

      // Crear un objeto para almacenar las categorías únicas
      //var uniqueCategories = {};

      // Filtrar y almacenar las categorías únicas en el objeto
      /*  r.forEach(function (item) {
        uniqueCategories[item.id_category] = item.category;
      }); */

      const uniqueCategories = r.reduce((acc, curr) => {
        if (!acc.includes(curr.category)) {
          acc.push(curr.category);
        }
        return acc;
      }, []);

      // Limpiar el select
      var $select = $("#selectCategory").empty();

      // Agregar la opción predeterminada al select
      $select.append("<option disabled selected>Categorias</option>");

      // Iterar sobre las categorías únicas y agregarlas al select
      for (var categoryId in uniqueCategories) {
        $select.append(
          `<option value="${categoryId}">${uniqueCategories[categoryId]}</option>`
        );
      }

      /* let $select = $(`#selectCategory`)
            $select.empty()

            $select.append(`<option option disabled selected > Categorias</option > `)

            for (let i = 0; i < r.length; i++) {
                if (i == 0) {
                    $select.append(
                        `<option option value = ${r[i].id_category}> ${r[i].category} </option > `,
                    )
                } else if (r[i].id_category != r[i - 1].id_category) {
                    $select.append(
                        `<option option value = ${r[i].id_category}> ${r[i].category} </option > `,
                    )
                }
            } */
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
