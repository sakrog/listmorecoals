$(document).ready(function() {
	$("#commentForm").validate({
		rules:{
			first_name: "required",
			last_name: "required",
			state: {
				maxlength: 2
			},
			email: {
				required: true,
				email: true
			},
			username: {
				required: true,
				minlength: 3
			},
			password: "required",
			agree: "required",

		},
		messages: {
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			state: {
				maxlength: "Please use abbrevation for your State"
			},
			email: {
				required: "Please enter a valid email address"
			},
			username: {
				required: "Please enter an unique username",
				minlength: "Your username must be at least 3 letters long"
			},
			password: "Please enter an unique password",
			agree: "Please accept to not troll"
		}
	});

	$("#username").focus(function(){
		var first_name = $("#first_name").val();
		var last_name = $("#last_name").val();
		if(first_name && last_name && !this.value) {
			this.value = first_name + "." + last_name;
		}
	});
});