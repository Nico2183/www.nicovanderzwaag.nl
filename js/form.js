(function($) {
    "use strict";
    $("#contactForm").validator().on("submit", function(event) {
      if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
      } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
      }
    });

    function submitForm() {
      // Initiate Variables With Form Content
      var name = $("#name").val();
      var email = $("#email").val();
      var msg_subject = $("#msg_subject").val();
      var message = $("#message").val();

      $.ajax({
        type: "POST",
        url: "assets/php/form-process.php",
        data: "name=" + name + "&email=" + email + "&msg_subject=" + msg_subject + "&message=" + message,
        success: function(text) {
          if (text == "success") {
            formSuccess();
          } else {
            formError();
            submitMSG(false, text);
          }
        }
      });
    }

    function formSuccess() {
      $("#contactFrm")[0].reset();
      submitMSG(true, "Message Submitted!")
    }

    function formError() {
      $("#contactFrm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
      });
    }

    function submitMSG(valid, msg) {
      if (valid) {
        var msgClasses = "h3 text-left tada animated text-success";
      } else {
        var msgClasses = "h3 text-left text-danger";
      }
      $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    };
