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
				'data[Tour][minors_price]': {
					required: true
				},
				'data[Time][Time][]': {
					required: true
				},
				'data[Winery][description]': {
					required: false,
					maxlength: 1000
				},
				'data[Winery][english_description]': {
					required: false,
					maxlength: 1000
				},
				'data[Winery][portuguese_description]': {
					required: false,
					maxlength: 1000
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
			$('.timepicker').on('blur', function(e){
				var container = $('.bootstrap-timepicker-widget').first();

				if (!container.is(e.relatedTarget) // if the destination of blur isn't the container...
					&& container.has(e.relatedTarget).length === 0) // ... nor a descendant of the container
				{
					$(this).timepicker('hideWidget');
				}
			});

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

	initColorPickers: function () {
		$("#tour-colorpicker").colorPicker({
			colors: [
				'#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3',
				'#03A9F4', '#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39',
				'#FFC107', '#FF9800', '#FF5722', '#795548', '#9E9E9E', '#607D8B'
			],
			customcolors: [],
			itemheight: 30,
			itemwidth: 30,
			insertcode: false,
			rowitem: 6,
			buttonclose: true,
			buttonfullscreen: true,
			fullscreen: false,
			esc: true,
			alignment: 'bl',
			colorformat: 'hex',
			onSelect: function(ui, color){
				ui.find('input').val(color);
				ui.find('button i').css('background-color', color);
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
			TourAddEdit.handleDatePickers();
		})
	},

	removeDay: function() {
		$('#all-datepickers-div').on('click', '.remove-day-button', function(){
			$(this).closest('.datepicker-div').remove();
		})
	},


	init: function (){
		TourAddEdit.handleTimePickers();
		TourAddEdit.validateTour();
		TourAddEdit.addTime();
		TourAddEdit.removeTime();
		TourAddEdit.initColorPickers();
		TourAddEdit.handleDatePickers();
		TourAddEdit.addDay();
		TourAddEdit.removeDay();
	}

}
