$(document).ready(function() {

  //load the modal page and show when clicked
  $('#register_btn').click(function() {
    $('.register').load('./includes/register_modal.php', function () {
      $('#registerModal').modal('show');
    });
  });

  $('#login_btn').click(function() {
    $('.login').load('./includes/login_modal.php', function () {
      $('#loginModal').modal('show');
    });
  });


  /*
    AJAX Search
   */
  let txtSearch = $('#search');
  let txtResult = $('.search-result');

  //make result show when search field is in focus
  /*txtSearch.focus(function() {
    //need condition to check on to
    txtResult.show();
  });*/

  txtSearch.keyup(function() {
    let keyword = $('#search').val();

    //check if user is typing in search
    if (keyword.length >= 2) {
      $.ajax({
        url       :  'ajax/search.php',
        type      :   'post',
        data      :   {'keyword' : keyword},
        success   :   function(data) {
          //check if there's data from result
          if (data.length > 1) {
            txtResult.show();
            txtResult.html(data);
          }
        }
      });
    }else {
      txtResult.hide();
    }
  });

  //delay the hide so the user can click on search result
  $('#search').blur(function() {
    $('.search-result').delay(100).hide(0);
  });

});