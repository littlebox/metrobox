var reserves = {

	setSelectsOnAddReserveForm: function(){
		$('#tour-selector').on('change', function(ev){
			val = $(this).val();
			tour = findTour(val);

			if(tour.select == undefined){
				var select = document.getElementById("language-selector");
				//Empty actual Language Selector
				while (select.firstChild) {
					select.removeChild(select.firstChild);
				}
				//Put each tour's language as select's option
				for(var i = 0, n = tour.Language.length; i < n; i++ ){
					var opt = document.createElement('option');
					select.appendChild(opt)
					opt.setAttribute('value',tour.Language[i].id);
					opt.textContent = tour.Language[i].name;
				}
				if(tour.Language.length <= 0){
					var opt = document.createElement('option');
					select.appendChild(opt)
					opt.textContent = 'No hay lenguajes asignados al tour.';
				}
				tour.select = select;
			}

			$('#language-selector').replaceWith(tour.select);

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
				autoclose: true
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

	initCalendar: function() {

		if (!jQuery().fullCalendar) {
			return;
		}

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var h = {};

		if (Metrobox.isRTL()) {
			if ($('#calendar').parents(".portlet").width() <= 720) {
				$('#calendar').addClass("mobile");
				h = {
					right: 'title, prev, next',
					center: '',
					left: 'agendaDay, agendaWeek, month, today'
				};
			} else {
				$('#calendar').removeClass("mobile");
				h = {
					right: 'title',
					center: '',
					left: 'agendaDay, agendaWeek, month, today, prev,next'
				};
			}
		} else {
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

	}

}