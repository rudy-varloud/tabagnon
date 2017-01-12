$(document).ready(function() {

  $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

    var data_id = '';

    if (typeof $(this).data('id') !== 'undefined') {

      data_id = $(this).data('id');
    }

    $('#my_element_id').val(data_id);
  });
});

