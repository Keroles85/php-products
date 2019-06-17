$(document).ready(function () {

  $('.fdbck-btn').click(function () {
    event.preventDefault();
    $.post('ajax/feedback.php',

      //serialize form data
      $('#feedback-form').serialize(),
      function (success) {
        if(success == success) {
          $('#feedback-form').hide();
          $('#feedback-success').show();
        }
      });
  });
});

//using serialize() instead
/*{
  name    : $('#name').val(),
  email   : $('#email').val(),
  comment : $('#comment').val()
}*/