var reserves = {

	setSelectsOnAddReserveForm: function(){
		$('#tour-selector').on('change', function(ev){
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
					selectLanguages.appendChild(opt)
					opt.setAttribute('value',tour.Language[i].id);
					opt.textContent = tour.Language[i].name;
				}
				if(tour.Language.length <= 0){
					var opt = document.createElement('option');
					selectLanguages.appendChild(opt)
					opt.textContent = 'No hay lenguajes asignados al tour.';
				}
				tour.select.languages = selectLanguages;

				//SET TIMES
				var selectTimes = document.getElementById("time-selector");
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
				tour.select.times = selectTimes;

			}

			$('#language-selector').replaceWith(tour.select.languages);
			$('#time-selector').replaceWith(tour.select.times);

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
				rtl: Metrobox.isRTL(),
				language: 'es',
				format: 'dd/mm/yyyy',
				orientation: "left",
				weekStart: 1,
				autoclose: true,
				daysOfWeekDisabled: [2],
			});

			$('.birth-date-picker').datepicker({
				rtl: Metrobox.isRTL(),
				startView: 'decade',
				language: 'es',
				format: 'dd/mm/yyyy',
				orientation: "left",
				weekStart: 1,
				autoclose: true,
				daysOfWeekDisabled: [2],
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
	validateReserve: function(){
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
				'data[Reserve][quantity]': {
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
				right: 'today,month,agendaWeek,agendaDay'
			};
		} else {
			$('#calendar').removeClass("mobile");
			h = {
				left: 'title',
				center: '',
				right: 'prev,next,today,month,agendaWeek,agendaDay'
			};
		}


		var initDrag = function(el) {
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim(el.text()) // use the element's text as the event title
			};
			// store the Event Object in the DOM element so we can get to it later
			el.data('eventObject', eventObject);
			// make the event draggable using jQuery UI
			el.draggable({
				zIndex: 999,
				revert: true, // will cause the event to go back to its
				revertDuration: 0 //  original position after the drag
			});
		};

		var addEvent = function(title) {
			title = title.length === 0 ? "Untitled Event" : title;
			var html = $('<div class="external-event label label-default">' + title + '</div>');
			jQuery('#event_box').append(html);
			initDrag(html);
		};

		$('#external-events div.external-event').each(function() {
			initDrag($(this));
		});

		$('#event_add').unbind('click').click(function() {
			var title = $('#event_title').val();
			addEvent(title);
		});

		//predefined events
		$('#event_box').html("");
		addEvent("Reserve 1");
		addEvent("Reserve 2");
		addEvent("Reserve 3");
		addEvent("Reserve 4");
		addEvent("Reserve 5");
		addEvent("Reserve 6");

		$('#calendar').fullCalendar('destroy'); // destroy the calendar
		$('#calendar').fullCalendar({ //re-initialize the calendar
			header: h,
			defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
			slotMinutes: 15,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				copiedEventObject.className = $(this).attr("data-class");

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				//if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				// }
			},
			events: [{
				title: 'Reserve',
				start: new Date(y, m, 1, 10, 30),
				backgroundColor: Metrobox.getBrandColor('yellow'),
				allDay: false,

			}, {
				title: 'Reserve',
				start: new Date(y, m, d - 5, 10, 30),
				backgroundColor: Metrobox.getBrandColor('green'),
				allDay: false,

			}, {
				title: 'Reserve',
				start: new Date(y, m, d - 3, 16, 0),
				backgroundColor: Metrobox.getBrandColor('red'),
				allDay: false,
			}, {
				title: 'Reserve',
				start: new Date(y, m, d + 4, 16, 0),
				backgroundColor: Metrobox.getBrandColor('green'),
				allDay: false,
			}, {
				title: 'Reserve',
				start: new Date(y, m, d, 10, 30),
				allDay: false,
			}, {
				title: 'Reserve',
				start: new Date(y, m, d, 12, 0),
				backgroundColor: Metrobox.getBrandColor('grey'),
				allDay: false,
			}, {
				title: 'Reserve',
				start: new Date(y, m, d + 1, 19, 0),
				backgroundColor: Metrobox.getBrandColor('purple'),
				allDay: false,
			}, {
				title: 'Reserve',
				start: new Date(y, m, 28, 17, 30),
				backgroundColor: Metrobox.getBrandColor('yellow'),
				allDay: false,
			}]
		});

	},

	init: function (){
		reserves.initCalendar();
		reserves.setSelectsOnAddReserveForm();
		reserves.handleDatePickers();
		reserves.handleTimePickers();
		reserves.validateReserve();
		reserves.intiSelects2();
		reserves.intiFindCLientListener();

	}

}