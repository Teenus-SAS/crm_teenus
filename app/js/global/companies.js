/* Cargar Empresas */

$.ajax({
  url: '../../../api/companies',
  success: function (r) {
    /* var info = JSON.parse(r) */
    let $select = $(`#selectCompanies`);
    $select.empty();

    $select.append(`<option disabled selected>Seleccionar</option>`);
    $.each(r, function (i, value) {
      $select.append(
        `<option value = ${value.id_company}> ${value.company_name} </option>`
      );
    });
  },
});

/* Cargar Contactos */

$('#selectCompanies').change(function (e) {
  e.preventDefault();
  loadContacts();
  loadBusiness();
});

loadContacts = () => {
  $.ajax({
    url: '../../../api/contacts',
    success: function (contacts) {
      let company = $('#selectCompanies').val();
      let $select = $(`#selectContact`);
      $select.empty();
      $select.append(`<option disabled selected>Seleccionar</option>`);

      for (let i = 0; i < contacts.length; i++) {
        if (company == contacts[i].id_company) {
          $select.append(
            `<option value = ${contacts[i].id_contact}> ${contacts[i].firstname} ${contacts[i].lastname} </option>`
          );
        }
      }
    },
  });
};

/* Cargar Proyectos */

loadBusiness = () => {
  $.ajax({
    url: '../../../api/business',
    success: function (business) {
      let company = $('#selectCompanies option:selected').text().trim();
      let $select = $(`#selectBusiness`);
      $select.empty();

      $select.append(`<option disabled selected>Seleccionar</option>`);

      for (let i = 0; i < business.length; i++) {
        if (company == business[i].company) {
          $select.append(
            `<option value = ${business[i].id_business}>${business[i].name_business}</option>`
          );
        }
      }
    },
  });
};
