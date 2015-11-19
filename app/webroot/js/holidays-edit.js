var HolidayEdit = {

	//Validations
	validateHoliday: function(){
		var thisForm = $('#holiday-edit-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Holiday][]': {
					required: true
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

	handleDatePickers: function () {

		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				language: 'es',
				format: 'dd/mm/yyyy',
				orientation: "left",
				weekStart: 1,
				autoclose: true,
				todayHighlight: true,
			});
		}

		/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
	},

	addDay: function() {
		datePickerDiv = $('#all-datepickers-div').children().first().clone(true).removeAttr('style').wrap('<div/>').parent().html();
		$('#all-datepickers-div').children().first().remove();

		$('#add-day-button').on('click', function(){
			$('#all-datepickers-div').append(datePickerDiv);
			HolidayEdit.handleDatePickers();
		})
	},

	removeDay: function() {
		$('#all-datepickers-div').on('click', '.remove-day-button', function(){
			$(this).closest('.datepicker-div').remove();
		})
	},


	init: function (){
		HolidayEdit.validateHoliday();
		HolidayEdit.handleDatePickers();
		HolidayEdit.addDay();
		HolidayEdit.removeDay();
	}

}
