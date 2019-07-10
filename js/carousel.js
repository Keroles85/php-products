$(document).ready(function() {
  //visible status change
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
            alert('Cannot set active item invisible');
            item.prop('checked', true);
          }
        } else {
          alert('Something went wrong, please try again');
        }
      });
  });

  //active status change
  $('.active').change(function () {
    let item = $(this);
    //alert(item.attr('data-id') + ' : ' + item.val());
    $.post('../ajax/carousel.php',
      {
        'action'  : 'active',
        'id'      : item.attr('data-id')
      },
      function (data, status) {
       if (status == 'success') {
          if (data == 'invisible') {
            alert('Cannot set invisible item active');
            location.reload();
          }
        } else {
         alert('Could not perform action ' + status);
       }
      });
  });
});