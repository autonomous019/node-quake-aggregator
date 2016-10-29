//i'm different
var UserApp = {};
(function(){
  UserApp.getUsers = function() { $.get('/users/get.json', function(response) {
    $label = $('#user-label');
    $userDiv = $('#users');
    $userDiv.empty();
    if (response.users.length === 0) {
      $label.hide();
      $userDiv.append('<div class="users">All done. Have a nice day .</div>');
    } else {
      $label.show();
      $.each(response.users, function(key, value) {

      });
    }
  });
};


})();

(function($) {
  $("#add-user").submit(function(event) {
    $('#user-error').remove();
    $('.form-group').removeClass('has-error');
    var $form = $(this),
      user = $form.find("input[name='to-do']").val(),
      url = $form.attr('action');

    var posting = $.post( url, { user : user } );
    posting.done(function( response ) {
      if (response.response.result == 'success') {
        $('#incomplete-users').empty();
        $('#inputLarge').val('');
        UserApp.getUsers();
      } else if (response.response.result == 'fail') {
        $('.form-group').addClass('has-error');
        $('#user-input').append('<div class="error" id="user-error">' + response.response.error.user + '</div>');
      }
    });
    event.preventDefault();
  });

  UserApp.getUsers();
  
})(jQuery);