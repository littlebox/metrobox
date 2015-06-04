var WineryAdminAddEdit = {

	//Validations
	validateWinery: function(){
		var thisForm = $('#winery-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Winery][name]': {
					required: true
				},
				'data[Winery][city]': {
					required: true
				},
				'data[Winery][address]': {
					required: true
				},
				'data[Winery][latitude]': {
					required: true
				},
				'data[Winery][longitude]': {
					required: true
				},
				'data[Winery][description]': {
					required: true
				},
				'data[Winery][priority]': {
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
				var container = $('#gmap_geocoding_all').first();
				if (!container.is(e.target) // if the key pressed isn't in the container...
					&& container.has(e.target).length === 0) // ... or in a descendant of the container
				{
					if (thisForm.validate().form()) {
						thisForm.submit();
					}
				}
				return false;
			}
		});
	},

	//Init Google Map
	mapGeocoding: function () {

		var map = new GMaps({
			div: '#gmap_geocoding',
			lat: typeof(initialLatitude) != 'undefined' ? initialLatitude : -32.8897764,
			lng: typeof(initialLongitude) != 'undefined' ? initialLongitude : -68.8444555,
			zoom: 14,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			streetViewControl: false,
			mapTypeControl: true,
		});

		var locationMarker;

		if(typeof(initialLatitude) != 'undefined' && typeof(initialLongitude) != 'undefined'){
			map.removeMarkers();
			locationMarker = map.addMarker({
				lat: initialLatitude,
				lng: initialLongitude,
				draggable: true,
				animation: google.maps.Animation.DROP,
				icon: new google.maps.MarkerImage(
					'/img/marker-wineobs.png',
					null,
					null,
					// new google.maps.Point(0,0),
					null,
					new google.maps.Size(36, 36)
				),
			});
			//muestro el texto de ayuda
			$('#marker-help-text').show();
		}

		autocomplete = new google.maps.places.Autocomplete((document.getElementById('gmap_geocoding_city')),{
			types: ['(regions)'],
			componentRestrictions: {country: 'ar'} });

		// When the user selects an address from the dropdown,
		// populate the address fields in the form.
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			place = autocomplete.getPlace().geometry.location;
			map.setCenter(place.lat(),place.lng());
		});


		var handleAction = function () {
			var text = $.trim($('#gmap_geocoding_city').val()+','+$('#gmap_geocoding_address').val());
			GMaps.geocode({
				address: text,
				callback: function (results, status) {
					if (status == 'OK') {
						//Centra el mapa en la latitud y longitu encontrada y pone el zoom en 16
						var latlng = results[0].geometry.location;
						map.setCenter(latlng.lat(), latlng.lng());
						map.setZoom(16);

						map.removeMarkers();

						locationMarker = map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							draggable: true,
							animation: google.maps.Animation.DROP,
							icon: new google.maps.MarkerImage(
								'/img/marker-wineobs.png',
								null,
								null,
								// new google.maps.Point(0,0),
								null,
								new google.maps.Size(36, 36)
							),
						});

						//muestro el texto de ayuda
						$('#marker-help-text').show();

						//Seteo la latitud y longitud en los inpus ocultos correspondientes
						$('#WineryLatitude').val(latlng.lat());
						$('#WineryLongitude').val(latlng.lng());

						//Seteamos un listener para que cada vez que se mueva el marcador, se actualice la latitud y la longitud en los inpus ocultos correspondientes
						google.maps.event.addListener(locationMarker, "mouseup", function(event) {
							$('#WineryLatitude').val(this.position.lat());
							$('#WineryLongitude').val(this.position.lng());
						});

						//Metrobox.scrollTo($('#gmap_geocoding'));
					}
				}
			});
		}

		var localizeCoordenates = function () {
			var text = $.trim($('#WineryLatitude').val()+', '+$('#WineryLongitude').val());
			GMaps.geocode({
				address: text,
				callback: function (results, status) {
					if (status == 'OK') {
						//Centra el mapa en la latitud y longitu encontrada y pone el zoom en 16
						var latlng = results[0].geometry.location;
						map.setCenter(latlng.lat(), latlng.lng());
						map.setZoom(16);

						map.removeMarkers();

						locationMarker = map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							draggable: true,
							animation: google.maps.Animation.DROP,
							icon: new google.maps.MarkerImage(
								'/img/marker-wineobs.png',
								null,
								null,
								// new google.maps.Point(0,0),
								null,
								new google.maps.Size(36, 36)
							),
						});

						//muestro el texto de ayuda
						$('#marker-help-text').show();

						//Seteamos un listener para que cada vez que se mueva el marcador, se actualice la latitud y la longitud en los inpus ocultos correspondientes
						google.maps.event.addListener(locationMarker, "mouseup", function(event) {
							$('#WineryLatitude').val(this.position.lat());
							$('#WineryLongitude').val(this.position.lng());
						});

						//Metrobox.scrollTo($('#gmap_geocoding'));
					}
				}
			});
		}

		$('#gmap_geocoding_btn').click(function(e) {
			e.preventDefault();
			handleAction();
		});

		$("#gmap_geocoding_form input").keypress(function(e) {
			var keycode = (e.keyCode ? e.keyCode : e.which);
			if (keycode == '13') {
				e.preventDefault();
				handleAction();
			}
		});

		$('#gmap_localize_coordenates_btn').click(function(e) {
			e.preventDefault();
			localizeCoordenates();
		});

		$("#gmap_geocoding_coordenates input").keypress(function(e) {
			var keycode = (e.keyCode ? e.keyCode : e.which);
			if (keycode == '13') {
				e.preventDefault();
				localizeCoordenates();
			}
		});


	},


	init: function (){
		WineryAdminAddEdit.validateWinery();
		WineryAdminAddEdit.mapGeocoding();
	}

}
