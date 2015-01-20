var ValidationRules = {
	'data[User][full_name]': {
		required: true,
	},
	'data[User][email]': {
		required: true,
		email: true
	},
	'data[User][current_password]': {
		required: true,
	},
	'data[User][password]': {
		required: true,
	},
	'data[User][password_confirm]': {
		equalTo: "#UserPassword",
	},
	'data[User][profile_picture]': {
		accept: "image/gif, image/jpeg, image/pjpeg, image/x-png, image/png, image/jpg",
	},
}