$(document).ready(function () {

  $('.fdbck-btn').click(function () {
    event.preventDefault();
    $.post('ajax/feedback.php',

      //serialize form data
      $('#feedback-form').serialize(), //{data : ''}
      function (status) {
        if(status == 'success') {
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