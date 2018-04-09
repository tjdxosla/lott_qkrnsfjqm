/**
 * 
 */
if(document.URL.indexOf('/member/join')> -1){
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
}
function loginValidate(form) {
	
	var frm = form;
	
	if(!frm.email.value){
		alert("아이디를 입력 하세요.");
		frm.email.focus();
		return false;
	}
	
	if(!frm.pass.value) {
		alert("비밀번호를 입력 하세요.");
		frm.pass.focus();
		return false;		
	}
	
	frm.method="POST";
	frm.action="/member/loginProc";
	frm.submit();
	
}