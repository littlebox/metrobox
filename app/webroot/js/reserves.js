var reserves = {

	setSelectsOnAddReserveForm: function(){
		$('#tour-selector').on('change', function(ev){
			if($(this).val()){ //If the value of selected Tour is defined
				val = $(this).val();
				tour = findTour(val);

				if(tour.select == undefined){
					tour.select = {};

					//SET LANGUAGES
					var selectLanguages = document.getElementById("language-selector");
					//Empty actual Language Selector
					while (selectLanguages.firstChild) {
						selectLanguages.removeChild(selectLanguages.firstChild);
					}
					//Put each tour's language as select's option
					for(var i = 0, n = tour.Language.length; i < n; i++ ){
						var opt = document.createElement('option');
						opt.setAttribute('value',tour.Language[i].id);
						opt.textContent = tour.Language[i].name;
						selectLanguages.appendChild(opt)
					}
					if(tour.Language.length <= 0){
						var opt = document.createElement('option');
						selectLanguages.appendChild(opt)
						opt.textContent = 'No hay lenguajes asignados al tour.';
					}
					tour.select.languages = selectLanguages.innerHTML;

					//SET TIMES
					var selectTimes = document.getElementById("time-selector");
					//Empty actual Times Selector
					while (selectTimes.firstChild) {
						selectTimes.removeChild(selectTimes.firstChild);
					}
					//Put each tour's time as select's option
					for(var i = 0, n = tour.Time.length; i < n; i++ ){
						var opt = document.createElement('option');
						opt.setAttribute('value',tour.Time[i].hour);
						opt.textContent = tour.Time[i].hour.substring(0, 5); //substring function is for cut the seconds in time string
						selectTimes.appendChild(opt)
					}
					if(tour.Time.length <= 0){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt)
						opt.textContent = 'No hay horarios asignados al tour.';
					}
					tour.select.times = selectTimes.innerHTML;

				}

				$('#language-selector').html(tour.select.languages);
				$('#time-selector').html(tour.select.times);

			} else { //If the selected is the empy option
				//SET LANGUAGES
				var selectLanguages = document.getElementById("language-selector");
				//Empty actual Language Selector
				while (selectLanguages.firstChild) {
					selectLanguages.removeChild(selectLanguages.firstChild);
				}
				//Put text as select's option
				var opt = document.createElement('option');
				opt.setAttribute('value','');
				opt.textContent = selecTourFirstText;
				selectLanguages.appendChild(opt)
				//SET TIMES
				var selectTimes = document.getElementById("time-selector");
				//Empty actual Language Selector
				while (selectTimes.firstChild) {
					selectTimes.removeChild(selectTimes.firstChild);
				}
				//Put text as select's option
				var opt = document.createElement('option');
				opt.setAttribute('value','');
				opt.textContent = selecTourFirstText;
				selectTimes.appendChild(opt)
			}
		});

		$('#tour-selector-modal').on('change', function(ev){
			if($(this).val()){ //If the value of selected Tour is defined
				val = $(this).val();
				tour = findTour(val);

				if(tour.select == undefined){
					tour.select = {};

					//SET LANGUAGES
					var selectLanguages = document.getElementById("language-selector-modal");
					//Empty actual Language Selector
					while (selectLanguages.firstChild) {
						selectLanguages.removeChild(selectLanguages.firstChild);
					}
					//Put each tour's language as select's option
					for(var i = 0, n = tour.Language.length; i < n; i++ ){
						var opt = document.createElement('option');
						selectLanguages.appendChild(opt)
						opt.setAttribute('value',tour.Language[i].id);
						opt.textContent = tour.Language[i].name;
					}
					if(tour.Language.length <= 0){
						var opt = document.createElement('option');
						selectLanguages.appendChild(opt)
						opt.textContent = 'No hay lenguajes asignados al tour.';
					}
					tour.select.languages = selectLanguages.innerHTML;

					//SET TIMES
					var selectTimes = document.getElementById("time-selector-modal");
					//Empty actual Times Selector
					while (selectTimes.firstChild) {
						selectTimes.removeChild(selectTimes.firstChild);
					}
					//Put each tour's time as select's option
					for(var i = 0, n = tour.Time.length; i < n; i++ ){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt)
						opt.setAttribute('value',tour.Time[i].hour);
						opt.textContent = tour.Time[i].hour.substring(0, 5); //substring function is for cut the seconds in time string
					}
					if(tour.Time.length <= 0){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt)
						opt.textContent = 'No hay horarios asignados al tour.';
					}
					tour.select.times = selectTimes.innerHTML;
				}

				$('#language-selector-modal').html(tour.select.languages);
				$('#time-selector-modal').html(tour.select.times);

			} else { //If the selected is the empy option
				//SET LANGUAGES
				var selectLanguages = document.getElementById("language-selector-modal");
				//Empty actual Language Selector
				while (selectLanguages.firstChild) {
					selectLanguages.removeChild(selectLanguages.firstChild);
				}
				//Put text as select's option
				var opt = document.createElement('option');
				opt.setAttribute('value','');
				opt.textContent = selecTourFirstText;
				selectLanguages.appendChild(opt)
				//SET TIMES
				var selectTimes = document.getElementById("time-selector-modal");
				//Empty actual Language Selector
				while (selectTimes.firstChild) {
					selectTimes.removeChild(selectTimes.firstChild);
				}
				//Put text as select's option
				var opt = document.createElement('option');
				opt.setAttribute('value','');
				opt.textContent = selecTourFirstText;
				selectTimes.appendChild(opt)
			}

		});

		var findTour = function(id) {
			for (var i = 0, len = toursData.length; i < len; i++) {
				if (parseInt(toursData[i].Tour.id) === parseInt(id)){
					return toursData[i]; // Return as soon as the object is found
				}
			}
			return null; // The object was not found
		}
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
				startDate: new Date(),
			});

			$('.birth-date-picker').datepicker({
				defaultViewDate: { year: new Date().getFullYear()-25, month: 01, day: 01 },
				startView: 'decade',
				language: 'es',
				format: 'dd/mm/yyyy',
				orientation: "left",
				weekStart: 1,
				autoclose: true,
			});
			//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		}

		/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
	},

	handleTimePickers: function () {

		if (jQuery().timepicker) {

			$('.timepicker-24').timepicker({
				autoclose: true,
				minuteStep: 5,
				showSeconds: false,
				showMeridian: false,
				defaultTime: false
			});

			// handle input group button click
			$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
				e.preventDefault();
				$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
			});
		}
	},

	intiSelects2: function(){
		$("#client-country").select2({
			placeholder: placeHolderCountrySelect,
			allowClear: true,
			formatResult: format,
			formatSelection: format,
			escapeMarkup: function (m) {
				return m;
			}
		});

		$("#client-country-modal").select2({
			placeholder: placeHolderCountrySelect,
			allowClear: true,
			formatResult: format,
			formatSelection: format,
			escapeMarkup: function (m) {
				return m;
			}
		});

		function format(state) {
			if (!state.id) return state.text; // optgroup
			return "<img class='flag' src='/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
		}
	},

	intiFindCLientListener: function(){
		timeToWait = 1000;

		timer = null;

		$("#client-email").on('input', function(){
			clearTimeout(timer);
			timer = setTimeout(findClient, timeToWait)
		});

	},

	//Validations
	validateAddReserve: function(){
		var thisForm = $('#reserve-add-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Reserve][tour_id]': {
					required: true
				},
				'data[Reserve][language_id]': {
					required: true
				},
				'data[Reserve][date]': {
					required: true
				},
				'data[Reserve][time]': {
					required: true
				},
				'data[Reserve][number_of_adults]': {
					required: true
				},
				'data[Reserve][number_of_minors]': {
					required: true
				},
				'data[Client][full_name]': {
					required: true
				},
				'data[Client][country]': {
					required: true
				},
				'data[Client][email]': {
					required: true
				},
				'data[Client][phone]': {
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
				sendReserveAddForm();
				//form.submit();
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

	validateEditReserve: function(){
		var thisForm = $('#reserve-edit-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Reserve][tour_id]': {
					required: true
				},
				'data[Reserve][language_id]': {
					required: true
				},
				'data[Reserve][date]': {
					required: true
				},
				'data[Reserve][time]': {
					required: true
				},
				'data[Reserve][number_of_adults]': {
					required: true
				},
				'data[Reserve][number_of_minors]': {
					required: true
				},
				'data[Client][full_name]': {
					required: true
				},
				'data[Client][country]': {
					required: true
				},
				'data[Client][email]': {
					required: true
				},
				'data[Client][phone]': {
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
				sendReserveEditForm();
				//form.submit();
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

	initCalendar: function() {

		if (!jQuery().fullCalendar) {
			return;
		}

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var h = {};


		if ($('#calendar').parents(".portlet").width() <= 720) {
			$('#calendar').addClass("mobile");
			h = {
				left: 'title, prev, next',
				center: '',
				//right: 'today,month,agendaWeek,agendaDay'
				right: 'today,month,basicWeek,basicDay'
			};
		} else {
			$('#calendar').removeClass("mobile");
			h = {
				left: 'title',
				center: '',
				//right: 'prev,next,today,month,agendaWeek,agendaDay'
				right: 'prev,next,today,month,basicWeek,basicDay'
			};
		}

		$('#calendar').fullCalendar('destroy'); // destroy the calendar
		$('#calendar').fullCalendar({ //re-initialize the calendar
			header: h,
			timeFormat: 'H:mm', // uppercase H for 24-hour clock //'h(:mm)t' like '7p' is the default
			defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
			slotMinutes: 15,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			eventClick: function(reserve, jsEvent, view) {
				//console.log(reserve);
				//Set data on reserves details modal popup form
				$('#id-modal').val(reserve.id);
				$('#tour-selector-modal').val(reserve.tour);
				$('#tour-selector-modal').trigger('change');
				$('#language-selector-modal').val(reserve.language);
				$('#date-modal').val(reserve.date.split('-').reverse().join('/'));
				$('#date-modal').datepicker('update');
				$('#time-selector-modal').val(reserve.time);
				$('#client-email-modal').val(reserve.clientEmail);
				$('#client-full-name-modal').val(reserve.clientName);
				$('#client-birth-date-modal').val(reserve.clientBirthDate.split('-').reverse().join('/'));
				$('#client-birth-date-modal').datepicker('update');
				$('#number-of-adults-modal').val(reserve.numberOfAdults);
				$('#number-of-minors-modal').val(reserve.numberOfMinors);
				$('#client-country-modal').select2("val", reserve.clientCountry);
				$('#client-phone-modal').val(reserve.clientPhone);

			},
			eventDrop: function(reserve, delta, revertFunc) {
				changeReserveDate(reserve, revertFunc);
			},
			events: getReservesUrl,
			eventRender: function(reserve, element, view) {
				addModalInitializers(element);
				addLanguageFlag(reserve, element);
			},

			// events: [{
			//	title: 'Reserve',
			//	start: new Date(y, m, 1, 10, 30),
			//	backgroundColor: Metrobox.getBrandColor('yellow'),
			//	allDay: false,

			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d - 5, 10, 30),
			//	backgroundColor: Metrobox.getBrandColor('green'),
			//	allDay: false,

			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d - 3, 16, 0),
			//	backgroundColor: Metrobox.getBrandColor('red'),
			//	allDay: false,
			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d + 4, 16, 0),
			//	backgroundColor: Metrobox.getBrandColor('green'),
			//	allDay: false,
			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d, 10, 30),
			//	allDay: false,
			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d, 12, 0),
			//	backgroundColor: Metrobox.getBrandColor('grey'),
			//	allDay: false,
			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, d + 1, 19, 0),
			//	backgroundColor: Metrobox.getBrandColor('purple'),
			//	allDay: false,
			// }, {
			//	title: 'Reserve',
			//	start: new Date(y, m, 28, 17, 30),
			//	backgroundColor: Metrobox.getBrandColor('yellow'),
			//	allDay: false,
			// }]
		});

		//Add attributes to all reserve events, needed to open reserve details modal view
		function addModalInitializers(element){
			element.attr('data-toggle', 'modal').attr('href', '#reserve-details');
		}

		//Add language flag to all reserve event
		function addLanguageFlag(reserve, element){
			switch (parseInt(reserve.language)) {
				case 1:
					element.find('.fc-time').append(" <img class='flag' src='/img/flags/es.png'/>");
					break;
				case 2:
					element.find('.fc-time').append(" <img class='flag' src='/img/flags/gb.png'/>");
					break;
				case 3:
					element.find('.fc-time').append(" <img class='flag' src='/img/flags/pt.png'/>");
					break;
			}
		}

	},




	init: function (){
		reserves.initCalendar();
		reserves.setSelectsOnAddReserveForm();
		reserves.handleDatePickers();
		reserves.handleTimePickers();
		reserves.validateAddReserve();
		reserves.validateEditReserve();
		reserves.intiSelects2();
		reserves.intiFindCLientListener();

	}

}