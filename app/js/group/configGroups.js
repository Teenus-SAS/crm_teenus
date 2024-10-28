$(document).ready(function () {
    loadAllDataGroups = async () => {
        let data = await searchData('/api/groups');
        setSelectGroups(data);

        let viewGroup = document.getElementById('btnNewGroup');

        if (viewGroup) {
            loadTblGroups(data);
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

    loadAllDataGroups();
});