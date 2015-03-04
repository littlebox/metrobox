var EstateAdd = {
	//Submit buttons in form start disabled until the pages finish load
	enableButtons: function() {
		$("#user-profile-info-edit-btn-save").removeClass('disabled');
		$("#user-profile-password-edit-btn-save").removeClass('disabled');
		$("#user-profile-picture-edit-btn-save").removeClass('disabled');
	},

	//Prepare picture preview for cropping
	setCropProfilePicture: function(){

		//Profile picture cropping function
		$('.fileinput').on('change.bs.fileinput',function(){
			$('#user-profile-picture-edit-btn-save').show();
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
	validateProfileInfo: function(){
		var thisForm = $('#user-profile-info-edit');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: ValidationRules, //from global-setups.js file

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
				error.insertAfter(element);
			},

			submitHandler: function(form) {
				EstateAdd.sendProfileInfoForm();
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

	validateProfilePassword: function(){
		var thisForm = $('#user-profile-password-edit');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: ValidationRules,


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
				error.insertAfter(element);
			},

			submitHandler: function(form) {
				EstateAdd.sendProfilePasswordForm();
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

	validateProfilePicture: function(){
		var thisForm = $('#user-profile-picture-edit');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: ValidationRules,


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
				error.insertAfter('.fileinput.fileinput-exists');
			},

			submitHandler: function(form) {
				EstateAdd.sendProfilePictureForm();
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

	//Save all original inputs values on an object
	LocalVar: {},
	setLocalVar: function(){
		$("form#user-profile-info-edit input[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			EstateAdd.LocalVar[input.attr('name')]=input.val();
		})
	},

	//Make editable Profile Info Form
	makeEditable: function(){
		$("form#user-profile-info-edit input[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			input.removeAttr('disabled');
		});
		$("#user-profile-info-edit-btn-cancel").show();
		$("#user-profile-info-edit-btn-save").show();
		$("#user-profile-info-edit-btn-edit").hide();
	},

	//Make non editable Profile Info form and reset fields to original values
	unmakeEditable: function(){
		$("form#user-profile-info-edit input[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			input.val(EstateAdd.LocalVar[input.attr('name')]);
			input.attr('disabled', 'disabled');

		});
		$("#user-profile-info-edit-btn-edit").show();
		$("#user-profile-info-edit-btn-cancel").hide();
		$("#user-profile-info-edit-btn-save").hide();
	},

	sendProfileInfoForm: function() {
		var button = $( '#user-profile-info-edit-btn-save' ).ladda();
		button.ladda( 'start' ); //Show loader in button

		var targeturl = $('#user-profile-info-edit').attr('action');
		var formData = $('#user-profile-info-edit').serializeArray();

		$.ajax({
			type: 'put',
			cache: false,
			url: targeturl,
			data: formData,
			dataType: 'json',
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
			},
			success: function(response) {
				if (response.content) {
					$('#page-alert-success').find('span').html(response.content);
					$('#page-alert-success').show();
					//Save new insputs values on an object LocalVar
					$("form#user-profile-info-edit input[type!='hidden']").each(function(){
						var input = $(this); // This is the jquery object of the input, do what you will
						EstateAdd.LocalVar[input.attr('name')]=input.val();
					});
					EstateAdd.unmakeEditable();
					$('#profile-usertitle-name').html(EstateAdd.LocalVar['data[User][full_name]']);
				}
				if (response.error) {
					$('#page-alert-danger').find('span').html(response.error);
					$('#page-alert-danger').show();
				}
			},
			error: function(e) {
				$('#page-alert-danger').find('span').html(e.responseJSON.message);
				$('#page-alert-danger').show();
			},
			complete: function(){
				button.ladda( 'stop' ); //Hide loader in button
			}
		});
	},

	sendProfilePasswordForm: function() {
		var button = $( '#user-profile-password-edit-btn-save' ).ladda();
		button.ladda( 'start' ); //Show loader in button

		var targeturl = $('#user-profile-password-edit').attr('action');
		var formData = $('#user-profile-password-edit').serializeArray();

		$.ajax({
			type: 'post',
			cache: false,
			url: targeturl,
			data: formData,
			dataType: 'json',
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
			},
			success: function(response) {
				if (response.content) {
					$('#page-alert-success').find('span').html(response.content);
					$('#page-alert-success').show();
					//Empty fields
					$("form#user-profile-password-edit input[type!='hidden']").each(function(){
						var input = $(this); // This is the jquery object of the input, do what you will
						input.val('');
					});
				}
				if (response.error) {
					$('#page-alert-danger').find('span').html(response.error);
					$('#page-alert-danger').show();
				}
			},
			error: function(e) {
				$('#page-alert-danger').find('span').html(e.responseJSON.message);
				$('#page-alert-danger').show();
			},
			complete: function(){
				button.ladda( 'stop' ); //Hide loader in button
			}
		});
	},

	sendProfilePictureForm: function (){
		var button = $( '#user-profile-picture-edit-btn-save' ).ladda();
		button.ladda( 'start' ); //Show loader in button
		button.ladda( 'setProgress', 0.1 );

		var targeturl = $('#user-profile-picture-edit').attr('action');
		var formData = new FormData(document.getElementById('user-profile-picture-edit'));

		pic = document.getElementById('profile_picture').files[0]

		xhr = new XMLHttpRequest();

		if(xhr.upload){
			xhr.upload.addEventListener("progress", updateProgress, false);
		}

		xhr.addEventListener("load", transferComplete, false);
		// xhr.addEventListener("error", transferFailed, false);
		// xhr.addEventListener("abort", transferCanceled, false);

		xhr.open('POST', targeturl, true);

		xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax

		function updateProgress(ev){
			p = (ev.loaded / ev.total);
			button.ladda( 'setProgress', p );
		}

		function transferComplete(ev){

			button.ladda('stop');

			var profileUserpic = $('.profile-userpic img');
			var thumbnail = $('.fileinput-new.thumbnail img');

			var src = profileUserpic.attr('src');
			profileUserpic.attr('src', '').attr('src', src +'?'+ Math.random()); //download new image without cache

			var src2 = thumbnail.attr('src');
			thumbnail.attr('src', '').attr('src', src2 +'?'+ Math.random()); //download new image without cache

		}
		xhr.send(formData);
	},

	eventListeners: function(){
		$('#user-profile-info-edit-btn-edit').on('click', EstateAdd.makeEditable);
		$('#user-profile-info-edit-btn-cancel').on('click', EstateAdd.unmakeEditable);
		//$('#user-profile-info-edit').on('submit', EstateAdd.validateProfileInfo);
		//$('#user-profile-picture-edit').on('submit', EstateAdd.sendProfilePictureForm);
		//$('#user-profile-password-edit').on('submit', EstateAdd.sendProfilePasswordForm);
	},

	init: function (){
		EstateAdd.eventListeners();
		EstateAdd.setLocalVar();
		EstateAdd.setCropProfilePicture();
		EstateAdd.validateProfileInfo();
		EstateAdd.validateProfilePassword();
		EstateAdd.validateProfilePicture();
		EstateAdd.enableButtons();
	}

}
