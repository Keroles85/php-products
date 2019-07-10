$(document).ready(function () {
  //when user changes categories
  $('#categories').change(function () {
    $.ajax({
      url   :   '../ajax/backend-products.php',
      type  :   'post',
      data  :   {'cat_id' : $(this).val()},
      success   :   function (data, status) {
                      status == 'success' ? $('.products').fadeOut(100, function() {
                        $(this).fadeIn().html(data);
                      }): '';
                      //$('.products').html(data);
                    }
    });
  });

});