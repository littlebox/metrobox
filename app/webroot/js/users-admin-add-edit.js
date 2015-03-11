var UserAdminAddEdit = {

	//Prepare picture preview for cropping
	setCropProfilePicture: function(){

		//Profile picture cropping function
		$('.fileinput').on('change.bs.fileinput',function(){
			img_prev = $('.fileinput-preview img');
			div = $('.fileinput-preview');
			img_prev.css('min-width','100px');
			img_prev.css('min-height','100px');
			img_prev.Jcrop({
				bgFade:true,
				bgOpacity: 0.5,
				bgColor: 'black',
				addClass: 'jcrop-light',
				setSelect: [ 0, 0, 200, 200 ],
				aspectRatio: 1,
				minSize: [20,20],
				onSelect: function(c){
					document.getElementById('profile_picture_x').value = c.x;
					document.getElementById('profile_picture_y').value = c.y;
					document.getElementById('profile_picture_w').value = c.w;
					document.getElementById('profile_picture_h').value = c.h;
					document.getElementById('profile_picture_ow').value = div.width();
					document.getElementById('profile_picture_oh').value = div.height();
				}
			});
		})
	},


	//Validations
	validateUser: function(){
		var thisForm = $('#user-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[User][full_name]': {
					required: true,
				},
				'data[User][email]': {
					required: true,
					email: true
				},
				'data[User][password_confirm]': {
					equalTo: "#UserPassword",
				},
				'data[User][group_id]': {
					required: true,
				},
				'data[User][winery_id]': {
					required: true,
				},
				'data[User][profile_picture]': {
					accept: "image/gif, image/jpeg, image/pjpeg, image/x-png, image/png, image/jpg",
				}
			},

			invalidHandler: function(event, validator) { //display error alert on form submit
				//$('.alert-danger', $('.login-form')).show();
			},

			highlight: function(element) { // hightlight error inputs
				$(element)
					.closest('.form-group').addClass('has-error'); // set error class to the control group
			},

			success: function(label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},

			errorPlacement: function(error, element) {
				if (element.attr('id') == 'profile_picture') {
					error.insertAfter('.fileinput.fileinput-exists');
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {
				form.submit();
			}
		});

		//Make for submitable by press enter
		thisForm.find('input').keypress(function(e) {
			if (e.which == 13) {
				if (thisForm.validate().form()) {
					thisForm.submit();
				}
				return false;
			}
		});
	},


	init: function (){
		UserAdminAddEdit.setCropProfilePicture();
		UserAdminAddEdit.validateUser();
	}

}
