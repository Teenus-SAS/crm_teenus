$(document).ready(function () {
    loadAllDataGroups = async () => {
        let data = await searchData('/api/groups');
        let viewGroup = document.getElementById('btnNewGroup');
 
        if (viewGroup) {
            setSelectGroups(data);
            loadTblGroups(data);
        } else {
            setCheboxGroups(data);
        }
    }

    const setSelectGroups = (data) => {
        let $select = $('#slctGroup');
        $select.empty();

        $select.append(`<option disabled selected>Seleccionar</option>`);
        
        $.each(data, function (i, value) {
            $select.append(`<option value='${value.id_group}'>${value.name_group}</option>`);
        });
    }

    const setCheboxGroups = (data) => {
        let $div = $('#divCheckboxGroup');
        $div.empty();
         
        $div.append(`
            <label for="slctGroup" class="form-label">Grupo</label>
            
            <div class="mt-1 checkbox checkbox-success checkbox-circle">
                <input class="checkboxGroup" id="all" type="checkbox">
                <label for="all">Todos</label>
            </div>
        `);
        
        $.each(data, function (i, value) {
            $div.append(`
                <div class="mt-1 checkbox checkbox-success checkbox-circle">
                    <input class="checkboxGroup" id="${value.id_group}" type="checkbox">
                    <label for="${value.id_group}">${value.name_group}</label>
                </div>
            `);
        });
    }

    loadAllDataGroups();
});