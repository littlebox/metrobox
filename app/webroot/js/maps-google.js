var MapsGoogle = function () {

	var mapGeocoding = function () {

		var map = new GMaps({
			div: '#gmap_geocoding',
			lat: -32.8897764,
			lng: -68.8444555,
			zoom: 14,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			streetViewControl: false,
			mapTypeControl: true,
		});

		var locationMarker;

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
			var text = $.trim($('#gmap_geocoding_city').val()+','+$('#gmap_geocoding_street').val()+' '+$('#gmap_geocoding_number').val());
			GMaps.geocode({
				address: text,
				callback: function (results, status) {
					if (status == 'OK') {
						//Centra el mapa en la latitud y longitu encontrada y pone el zoom en 16
						var latlng = results[0].geometry.location;
						map.setCenter(latlng.lat(), latlng.lng());
						map.setZoom(16);

						map.removeMarkers();

						mapGeocoding.locationMarker = map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							draggable: true,
							animation: google.maps.Animation.DROP,
							icon: new google.maps.MarkerImage(
								'/img/marker-orange.png',
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
						$('#EstateLatitude').val(latlng.lat());
						$('#EstateLongitude').val(latlng.lng());

						//Seteamos un listener para que cada vez que se mueva el marcador, se actualice la latitud y la longitud en los inpus ocultos correspondientes
						google.maps.event.addListener(mapGeocoding.locationMarker, "mouseup", function(event) {
							$('#EstateLatitude').val(this.position.lat());
							$('#EstateLongitude').val(this.position.lng());
						});

						Metrobox.scrollTo($('#gmap_geocoding'));
					}
				}
			});
		}

		$('#gmap_geocoding_btn').click(function (e) {
			e.preventDefault();
			handleAction();
		});

		$("#gmap_geocoding_form").keypress(function (e) {
			var keycode = (e.keyCode ? e.keyCode : e.which);
			if (keycode == '13') {
				e.preventDefault();
				handleAction();
			}
		});

	}



	return {
		//main function to initiate map samples
		init: function () {
			mapGeocoding();
		}

	};

}();