$(document).ready(function() {

  $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

    var data_id = '';

    if (typeof $(this).data('id') !== 'undefined') {

      data_id = $(this).data('id');
    }

    $('#my_element_id').val(data_id);
  });
});

function verifGuide(){
    var guide_select = $('.nomGuideVisite').val();
    var guide_input = $('.nomGuideVisMan').val();
    
    alert(guide_select);
}
