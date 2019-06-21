$(document).ready(function () {
  //when user changes categories
  $('#categories').change(function () {
    $.ajax({
      url   :   '../ajax/backend-products.php',
      type  :   'post',
      data  :   {'cat_id' : $(this).val()},
      success   :   function (data, success) {
                      success == success ? $('.products').html(data) : '';
                    }
    });
  });

});