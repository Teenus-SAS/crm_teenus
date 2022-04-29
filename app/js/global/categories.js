/* Load companies */

$(document).ready(function() {

    $.ajax({
        url: '/api/categories',
        success: function(r) {
            sessionStorage.setItem('categories', JSON.stringify(r))

            let $select = $(`#selectCategory`)
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
            }
        },
    })
})

/* Cargar subcategorias */

$('#selectCategory').change(function(e) {
    e.preventDefault();

    $select = $(`#selectSubcategory`)
    $select.empty()

    categories = sessionStorage.getItem('categories')
    r = JSON.parse(categories)
    category = $('#selectCategory').val()

    for (let i = 0; i < r.length; i++) {
        if (category == r[i].id_category) {
            $select.append(
                `<option option value = ${r[i].id_subcategory}> ${r[i].subcategory} </option > `,
            )
        }
    }
});