var WineryView = {
	//Submit buttons in form start disabled until the pages finish load
	enableButtons: function() {
		$("#winery-profile-info-edit-btn-save").removeClass('disabled');
		$("#winery-profile-password-edit-btn-save").removeClass('disabled');
		$("#winery-profile-picture-edit-btn-save").removeClass('disabled');
	},

	//Validations
	validateProfileInfo: function(){
		var thisForm = $('#winery-profile-info-edit');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Winery][name]': {
					required: true
				},
				'data[Winery][description]': {
					required: false
				},
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
				error.insertAfter(element);
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

	//Save all original inputs values on an object
	LocalVar: {},
	setLocalVar: function(){
		$("form#winery-profile-info-edit input[type!='hidden'], form#winery-profile-info-edit textarea[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			WineryView.LocalVar[input.attr('name')]=input.val();
		})
	},

	//Make editable Profile Info Form
	makeEditable: function(){
		$("form#winery-profile-info-edit input[type!='hidden'], form#winery-profile-info-edit textarea[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			input.removeAttr('disabled');
		});
		$("#winery-profile-info-edit-btn-cancel").show();
		$("#winery-profile-info-edit-btn-save").show();
		$("#winery-profile-info-edit-btn-edit").hide();
	},

	//Make non editable Profile Info form and reset fields to original values
	unmakeEditable: function(){
		$("form#winery-profile-info-edit input[type!='hidden'], form#winery-profile-info-edit textarea[type!='hidden']").each(function(){
			var input = $(this); // This is the jquery object of the input, do what you will
			input.val(WineryView.LocalVar[input.attr('name')]);
			input.attr('disabled', 'disabled');

		});
		$("#winery-profile-info-edit-btn-edit").show();
		$("#winery-profile-info-edit-btn-cancel").hide();
		$("#winery-profile-info-edit-btn-save").hide();
	},

	eventListeners: function(){
		$('#winery-profile-info-edit-btn-edit').on('click', WineryView.makeEditable);
		$('#winery-profile-info-edit-btn-cancel').on('click', WineryView.unmakeEditable);
		//$('#winery-profile-info-edit').on('submit', WineryView.validateProfileInfo);
		//$('#winery-profile-picture-edit').on('submit', WineryView.sendProfilePictureForm);
		//$('#winery-profile-password-edit').on('submit', WineryView.sendProfilePasswordForm);
	},

	init: function (){
		WineryView.eventListeners();
		WineryView.setLocalVar();
		WineryView.validateProfileInfo();
		WineryView.enableButtons();
	}

}
