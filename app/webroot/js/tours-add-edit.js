var TourAddEdit = {

	//Validations
	validateTour: function(){
		var thisForm = $('#tour-add-edit-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Tour][name]': {
					required: true
				},
				'data[Tour][lenght]': {
					required: true
				},
				'data[Tour][quota]': {
					required: true
				},
				'data[Tour][price]': {
					required: true
				},
				'data[Time][Time][]': {
					required: true
				},
				'data[Tour][description]': {
					required: true
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
				error.insertAfter(element); // for other inputs, just perform default behavior

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

	handleTimePickers: function () {

		if (jQuery().timepicker) {

			$('.timepicker-length').timepicker({
				autoclose: true,
				minuteStep: 15,
				showSeconds: false,
				showMeridian: false,
				defaultTime: '01:30'
			});

			$('.timepicker-time').timepicker({
				autoclose: true,
				minuteStep: 15,
				showSeconds: false,
				showMeridian: false,
				defaultTime: '09:00'
			});

			// handle input group button click
			$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
				e.preventDefault();
				$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
			});

			// Hide widgew on lost focus
			// $('.timepicker').on('blur', function(e){
			// 	e.preventDefault();
			// 	$(this).timepicker('hideWidget');
			// });

		}
	},

	addTime: function() {
		timePickerDiv = $('#all-timepickers-div').children().first().clone(true).removeAttr('style').wrap('<div/>').parent().html();
		$('#all-timepickers-div').children().first().remove();

		$('#add-time-button').on('click', function(){
			$('#all-timepickers-div').append(timePickerDiv);
			TourAddEdit.handleTimePickers();
		})
	},

	removeTime: function() {
		$('#all-timepickers-div').on('click', '.remove-time-button', function(){
			$(this).closest('.timepicker-div').remove();
		})
	},


	init: function (){
		TourAddEdit.handleTimePickers();
		TourAddEdit.validateTour();
		TourAddEdit.addTime();
		TourAddEdit.removeTime();
	}

}