$(document).ready(function () {

    $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

        var data_id = '';

        if (typeof $(this).data('id') !== 'undefined') {

            data_id = $(this).data('id');
        }

        $('#my_element_id').val(data_id);
    });
});

function verifGuide() {
    var guide_select = $('.nomGuideVisite').val();
    var guide_input = $('.nomGuideVisMan').val();

    alert(guide_select);
}

$(document).ready(function () {

    $('.datepicker').pickadate({
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        close: 'Fermer',
        formatSubmit: 'yyyy/mm/dd',
        hiddenName: true
    });
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm ',
        interval: 15,
        minTime: '06:00',
        maxTime: '22:00',
        defaultTime: '6:00',
        startTime: '6:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});

function checkSelected() {
    if (document.getElementById('date_selected').value !== "0") {
        document.getElementById('nbPlaceVoulu').disabled = "";
    } else {
        document.getElementById('nbPlaceVoulu').disabled = "disabled";
    }
    $("#date_selected").change(function () {
        if ($(this).data('options') == undefined) {
            /*Taking an array of all options-2 and kind of embedding it on the select1*/
            $(this).data('options', $('#nbPlaceVoulu option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#nbPlaceVoulu').html(options);
    });
}

