$(document).ready(function () {
    contactForms = async () => {
        try {
            let res = await fetch('/api/contactForms');
            r = await res.json();

            sessionStorage.setItem('contactForms', JSON.stringify(r));

            let $select = $(`#selectContactForms`);
            $select.empty();

            $select.append(`<option disabled selected > Seleccionar</option > `);

            for (let i = 0; i < r.length; i++) {
                if (i == 0) {
                    $select.append(
                        `<option value = ${r[i].id_contact_form}> ${r[i].contact_form} </option > `,
                    );
                } else if (r[i].id_category != r[i - 1].id_contact_form) {
                    $select.append(
                        `<option value = ${r[i].id_contact_form}> ${r[i].contact_form} </option > `,
                    );
                }
            }

        } catch (error) {
            console.log(error);
        }
    }

    contactForms();
});