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


$(function () {
    $(".datepicker").datepicker();
    $.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        prevText: '<Préc', prevStatus: 'Voir le mois précédent',
        nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun',
            'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
        weekHeader: 'Sm', weekStatus: '',
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
        dateFormat: 'yy/mm/dd', firstDay: 0,
        initStatus: 'Choisir la date', isRTL: false};
    $.datepicker.setDefaults($.datepicker.regional['fr']);
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


