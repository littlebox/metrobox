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
						selectLanguages.appendChild(opt);
					}
					if(tour.Language.length <= 0){
						var opt = document.createElement('option');
						selectLanguages.appendChild(opt);
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
						selectTimes.appendChild(opt);
					}
					if(tour.Time.length <= 0){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt);
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
				selectLanguages.appendChild(opt);
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
				selectTimes.appendChild(opt);
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
						selectLanguages.appendChild(opt);
						opt.setAttribute('value',tour.Language[i].id);
						opt.textContent = tour.Language[i].name;
					}
					if(tour.Language.length <= 0){
						var opt = document.createElement('option');
						selectLanguages.appendChild(opt);
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
						selectTimes.appendChild(opt);
						opt.setAttribute('value',tour.Time[i].hour);
						opt.textContent = tour.Time[i].hour.substring(0, 5); //substring function is for cut the seconds in time string
					}
					if(tour.Time.length <= 0){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt);
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
				selectLanguages.appendChild(opt);
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
				selectTimes.appendChild(opt);
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

	setQuotaAvailableEvent: function(){
		$('#tour-selector').on('change', reserves.setQuotaAvailable)
	},

	setQuotaAvailable: function(){


		if($('#tour-selector').val() == ""){
			var selectTimes = document.getElementById("time-selector");
			//Empty actual Times Selector
			while (selectTimes.firstChild) {
				selectTimes.removeChild(selectTimes.firstChild);
			}

			var opt = document.createElement('option');
			opt.textContent = 'Primero seleccione un tour';
			selectTimes.appendChild(opt);
		}


		if($('#tour-selector').val() != "" && $('#date-selector').val() != ""){
			$('#time-selector').prop('disabled', true);
			$('#date-selector-spinner').show();
			prevVal = $('#time-selector').val();
			dateToFormat = [];
			dateToFormat = $('#date-selector').val().split('/');
			formatedDate = dateToFormat[2]+'-'+dateToFormat[1]+'-'+dateToFormat[0]

			$.ajax({
				type: 'get',
				cache: false,
				url: getQuotaAvailable+formatedDate+'/'+$('#tour-selector').val(),
				//data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					//console.log(response);
					//SET TIMES
					var selectTimes = document.getElementById("time-selector");
					//Empty actual Times Selector
					while (selectTimes.firstChild) {
						selectTimes.removeChild(selectTimes.firstChild);
					}
					//Put each tour's time as select's option
					for(var i = 0, n = response.Time.length; i < n; i++ ){
						var opt = document.createElement('option');
						opt.setAttribute('value',response.Time[i].hour);
						if (prevVal == response.Time[i].hour) opt.setAttribute('selected', 'selected');
						opt.textContent = response.Time[i].hour.substring(0, 5) + ' ('+response.Time[i].quota_available+' cupos disponibles)'; //substring function is for cut the seconds in time string
						selectTimes.appendChild(opt);
					}
					if(tour.Time.length <= 0){
						var opt = document.createElement('option');
						selectTimes.appendChild(opt);
						opt.textContent = 'No hay horarios asignados al tour.';
					}
					//tour.select.times = selectTimes.innerHTML;
				},
				error: function(e) {
					console.log('Ajax error: '+e.responseText.message);
				},
				complete: function(){
					$('#time-selector').prop('disabled', false);
					$('#date-selector-spinner').hide();
					//$('#client-email-spinner').hide();
				}
			});
		}
	},

	setToursAvailablesInSelectedDate: function(){
		$('#date-selector').on('change', function(ev){

			$('#time-selector').prop('disabled', true);
			$('#date-selector-spinner').show();
			prevVal = $('#tour-selector').val();
			dateToFormat = [];
			dateToFormat = $('#date-selector').val().split('/');
			formatedDate = dateToFormat[2]+'-'+dateToFormat[1]+'-'+dateToFormat[0]

			$.ajax({
				type: 'get',
				cache: false,
				url: getToursAvailablesInSelectedDate+formatedDate,
				//data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					// console.log(response);
					//SET TIMES
					var tourSelector = document.getElementById("tour-selector");
					//Empty actual Times Selector
					while (tourSelector.firstChild) {
						tourSelector.removeChild(tourSelector.firstChild);
					}

					if(response.length > 0){
						var opt = document.createElement('option');
						opt.textContent = 'Seleccione un tour...';
						opt.setAttribute('value','');
						tourSelector.appendChild(opt);
						//Put each tour's time as select's option
						for(var i = 0, n = response.length; i < n; i++ ){
							var opt = document.createElement('option');
							opt.setAttribute('value',response[i].Tour.id);
							if (prevVal == response[i].Tour.id) opt.setAttribute('selected', 'selected');
							opt.textContent = response[i].Tour.name; //substring function is for cut the seconds in time string
							tourSelector.appendChild(opt);
						}
						reserves.setQuotaAvailable();
					}else{
						var opt = document.createElement('option');
						tourSelector.appendChild(opt);
						opt.textContent = 'No hay tours disponibles en el días seleccionado.';
					}
				},
				error: function(e) {
					console.log('Ajax error: '+e.responseText.message);
					$('#time-selector').prop('disabled', false);
					$('#date-selector-spinner').hide();
				},
				complete: function(){
					$('#time-selector').prop('disabled', false);
					$('#date-selector-spinner').hide();
					//$('#client-email-spinner').hide();
				}
			});

		})
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

	editReserveButtons: function(){
		//Edit Reserve Functions
		$('#edit-modal-btn').on('click', function(){
			reserves.editReserveModalFunctions.editModeOn();
			reserves.editReserveModalFunctions.savePrevValues();
		});

		$('#cancel-edit-modal-btn').on('click', function(){
			reserves.editReserveModalFunctions.editModeOff();
			reserves.editReserveModalFunctions.restorePrevValues();
		});

		$('#attended-modal').on('click', function() {
			checkAttend();
		});
	},

	editReserveModalFunctions: {

		editModeOn: function(){
			$('#edit-modal-btn').hide();
			$('#reserve-delete-modal-btn').hide();
			$('#cancel-edit-modal-btn').show();
			$('#reserve-edit-submit-button').show();
			$('#reserve-details .form-control').prop('disabled', false);
		},

		editModeOff: function(){
			$('#cancel-edit-modal-btn').hide();
			$('#reserve-edit-submit-button').hide();
			$('#edit-modal-btn').show();
			$('#reserve-delete-modal-btn').show();
			$('#reserve-details .form-control').prop('disabled', true);
		},

		prevValues: [],

		savePrevValues: function(){
			$("#reserve-details .form-control").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				reserves.editReserveModalFunctions.prevValues[input.attr('name')] = input.val();
			})
		},

		restorePrevValues: function(){
			$("#reserve-details .form-control").each(function(){
				var input = $(this); // This is the jquery object of the input, do what you will
				input.val(reserves.editReserveModalFunctions.prevValues[input.attr('name')]);
				if(input.hasClass('select2-offscreen')){ //is select2 selector?
					input.select2('val', reserves.editReserveModalFunctions.prevValues[input.attr('name')]);
				}
			});
		}
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
				'data[Reserve][note]': {
					required: false
				},
				'data[Client][full_name]': {
					required: true
				},
				'data[Client][country]': {
					required: false
				},
				'data[Client][birth_date]': {
					required: false
				},
				'data[Client][email]': {
					required: false
				},
				'data[Client][phone]': {
					required: false
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
				'data[Reserve][note]': {
					required: false
				},
				'data[Reserve][referer]': {
					required: false
				},
				'data[Client][full_name]': {
					required: true
				},
				'data[Client][country]': {
					required: false
				},
				'data[Client][birth_date]': {
					required: false
				},
				'data[Client][email]': {
					required: true
				},
				'data[Client][phone]': {
					required: false
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
				if(reserve.clientBirthDate != null) $('#client-birth-date-modal').val(reserve.clientBirthDate.split('-').reverse().join('/'));
				$('#client-birth-date-modal').datepicker('update');
				$('#number-of-adults-modal').val(reserve.numberOfAdults);
				$('#number-of-minors-modal').val(reserve.numberOfMinors);
				$('#note-modal').val(reserve.note);
				$('#client-country-modal').select2("val", reserve.clientCountry);
				$('#referer-modal').val(reserve.referer);
				$('#client-phone-modal').val(reserve.clientPhone);
				//Mark or not Attended checkbox
				if(reserve.attended){
					$('#attended-modal')[0].checked = true;
					$('#attended-modal').trigger('change');
				}else{
					$('#attended-modal')[0].checked = false;
					$('#attended-modal').trigger('change');
				}
				//Put edit mode off
				reserves.editReserveModalFunctions.editModeOff();

			},
			eventDrop: function(reserve, delta, revertFunc) {
				changeReserveDate(reserve, revertFunc);
			},
			eventSources: getReservesUrl,
			eventRender: function(reserve, element, view) {
				addModalInitializers(element);
				addLanguageFlag(reserve, element);
				addCheckOnAttended(reserve, element);
				addWineobsLogo(reserve, element);
				addPaidMark(reserve, element);
			},
			loading: function( isLoading, view ) {
				if(isLoading){
					$('.fc-button-group').prepend('<button id="fc-ajax-spinner" type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left"><span class="fa fa-spinner fa-pulse" display="font-size: 18px"></span></button>');
				}else{
					$('#fc-ajax-spinner').remove();
				}
			}
		});

		//Add tour filter selector
		$('.fc-button-group').append(filterByTourSelect);

		//Set tour filter change action
		var currentSource = getReservesUrl;
		var newSource = '';
		$('#tour-filter').on('change', function(){
			//If tour filter has value ("All tours" has not value)
			if ($('#tour-filter').val()){
				newSource = getReservesUrl+'?tour='+$('#tour-filter').val();
			} else {
				newSource = getReservesUrl;
			}

			//remove the old eventSources and remove events
			$('#calendar').fullCalendar('removeEventSource', currentSource);
			$('#calendar').fullCalendar('removeEvents');
			//attach the new eventSources and bring events
			$('#calendar').fullCalendar('addEventSource', newSource);

			currentSource = newSource;
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

		//Add check icon on attended reserve events
		function addCheckOnAttended(reserve, element){
			if(reserve.attended){
				element.find('.fc-content').prepend("<i class='fa fa-check' style='float: left;'></i>");
			}
		}

		//Add wineobs icon on reserves made from web
		function addWineobsLogo(reserve, element){
			if(reserve.from_web){
				element.find('.fc-time').append(" <img class='flag' src='/img/wineobs_mark.png'/>");
			}
		}

		//Add dollar icon forpaid reserves made from web
		function addPaidMark(reserve, element){
			if(reserve.paid){
				element.find('.fc-time').append(" <i class='fa fa-credit-card'></i>");
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
		//reserves.intiFindCLientListener();
		reserves.editReserveButtons();
		reserves.setQuotaAvailableEvent();
		reserves.setToursAvailablesInSelectedDate();
	}

}