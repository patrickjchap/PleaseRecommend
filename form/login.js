$(document).ready(function(){
	$("#loginForm").validate({
		rules: {
			username:{
				required: true,
				minlength: 2,
				maxlength: 40
			},
			password:{
				required: true,
				minlength: 6
			}
		}, messages : {
			username:{
				required:"Username is required.",
				minlength:"Username must be at least 2 characters.",
				maxlength:"Username cannot be larger than 40 characters"
			},
			password:{
				required:"Password is required.",
				minlength:"Password must be at least 6 characters."
			}
		},
		
	});

});