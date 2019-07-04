$(document).ready(function() {
  $('.visible-cb').change(function() {
    let item = $(this);
    $.post('../ajax/carousel.php',
      {
        'action'  : 'visible',
        'id'      : item.attr('data-id'),
        'visible' : item.is(':checked') ? 1 : 0
      },
      function(data, status) {
        if (status == 'success') {
          if (data == 'active') {
            alert('Cannot change active item');
            item.prop('checked', true);
          }
        } else {
          alert('Something went wrong, please try again');
        }
      });
  });
});