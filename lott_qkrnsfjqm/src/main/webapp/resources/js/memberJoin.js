/**
 * 
 */

$(".login-form").validate({
  rules: {
    username: {
      required: true,
      minlength: 4
    },     
    email: {
      required: true,
      email:true
    },
    password: {
      required: true,
      minlength: 5
    },
    cpassword: {
      required: true,
      minlength: 5,
      equalTo: "#password"
    },
    phone:{
        required: true,
        minlength: 5
    }
  },
  //For custom messages
  messages: {
    username:{
      required: "Enter a username",
      minlength: "Enter at least 4 characters"
    },
    phone:{
        required: "- 빼고 입력 하세요.",
        minlength: "Enter at least 4 characters"
    	
    }
  },
  errorElement : 'div',
  errorPlacement: function(error, element) {
    var placement = $(element).data('error');
    if (placement) {
      $(placement).append(error)
    } else {
      error.insertAfter(element);
    }
  }
});