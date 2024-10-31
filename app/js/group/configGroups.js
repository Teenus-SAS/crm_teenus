$(document).ready(function () {
    loadAllDataGroups = async () => {
        try {
            const data = await searchData('/api/groups');
            const viewGroup = document.getElementById('btnNewGroup');

            if (viewGroup) {
                setSelectGroups(data);
                loadTblGroups(data);
            } else {
                setCheckboxGroups(data);
            }
        } catch (error) {
            console.error("Error loading groups:", error);
        }
    };

    const setSelectGroups = (data) => {
        const $select = $('#slctGroup').empty().append('<option disabled selected>Seleccionar</option>');
        const options = data.map(value => `<option value="${value.id_group}">${value.name_group}</option>`);
        $select.append(options);
    };

    const setCheckboxGroups = (data) => {
        const $div = $('#divCheckboxGroup').empty();
        const allCheckbox = `
            <label for="slctGroup" class="form-label">Grupo</label>
            <div class="mt-1 checkbox checkbox-success checkbox-circle">
                <input class="checkboxGroup" id="all" type="checkbox">
                <label for="all">Todos</label>
            </div>
        `;
        const groupCheckboxes = data.map(value => `
            <div class="mt-1 checkbox checkbox-success checkbox-circle">
                <input class="checkboxGroup" id="${value.id_group}" type="checkbox">    
                <label for="${value.id_group}">${value.name_group}</label>
            </div>
        `);
        $div.append(allCheckbox + groupCheckboxes.join(''));
    };

    loadAllDataGroups();
});
