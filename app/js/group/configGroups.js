$(document).ready(function () {
    loadAllDataGroups = async () => {
        let data = await searchData('/api/groups');
        let viewGroup = document.getElementById('btnNewGroup');

        viewGroup ? op = 1 : op = 2;

        setSelectGroups(data,op);

        if (viewGroup) {
            loadTblGroups(data);
        }
    }

    const setSelectGroups = (data, op) => {
        let $select = $('#slctGroup');
        $select.empty();

        $select.append(`<option disabled selected>Seleccionar</option>`);
        
        if (op == 2) {
            $select.append(`<option value='all'>Todos</option>`);            
        }
        $.each(data, function (i, value) {
            $select.append(`<option value='${value.id_group}'>${value.name_group}</option>`);
        });
    }

    loadAllDataGroups();
});