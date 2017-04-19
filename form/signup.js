$(document).ready(function(){
	$("#signupForm").validate({
		rules: {
			desired_username:{
				required: true,
				minlength: 2,
				maxlength: 40
			},
			desired_email:{
				required: true,
				minlength: 2,
				maxlength: 40
			},
			repdesired_email:{
				equalTo: '#email',
				required: true
			},
			desired_fname:{
				maxlength:40
			},
			desired_lname:{
				maxlength:40
			},
			desired_pass:{
				minlength: 6,
				required: true
			},
			repdesired_pass:{
				equalTo:'#pass',
				required:true
			}
		}, messages : {
			desired_username:{
				required: "Required.",
				minlength: "Must be length 2 or more.",
				maxlength: "Must be less than 40 characters."
			},
			desired_email:{
				required: "Required.",
				minlength: "Must be length 2 or more.",
				maxlength: "Must be less than 40 characters."
			},
			repdesired_email:{
				equalTo: "Must match email.",
				required: "Required."
			},
			desired_fname:{
				maxlength:"Wow, you have a long name"
			},
			desired_lname:{
				maxlength:"Wow, you have a long name"
			},
			desired_pass:{
				minlength: "Must be at least 6 characters",
				required: "Required."
			},
			repdesired_pass:{
				equalTo:"Passwords do not match",
				required:"Required."
			}
		},
		
	});

});