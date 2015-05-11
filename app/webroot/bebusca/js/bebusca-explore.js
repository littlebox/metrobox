(function($){
	"use strict";
	var mapOptions = {
		center: { lat: -32.890183, lng: -68.8440498},
		zoom: 14,
		disableDefaultUI: true,
	};

	var newMarker = null;
	var markers = [];

	// json for properties markers on map
	var props = [{
		title : 'Residencia Moderna en Dalvian',
		image : '1-1-thmb.png',
		type : 'Venta',
		price : '$1,550,000',
		address : 'Calle Falsa 123, Las Heras, Mendoza',
		bedrooms : '3',
		bathrooms : '2',
		area : '3430 m2',
		position : {
			lat : -32.8843989418938,
			lng : -68.84862028416137
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Casa Muy Bonita',
		image : '2-1-thmb.png',
		type : 'Alquiler',
		price : '$1,750,000',
		address : 'Otra Calle 865, Godoy Cruz, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '4430 m2',
		position : {
			lat : -32.88895774818249,
			lng : -68.85443531330566
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansa Mansión',
		image : '3-1-thmb.png',
		type : 'Venta',
		price : '$1,340,000',
		address : 'Ricachon 2365, San Isidro, Buenos Aires',
		bedrooms : '2',
		bathrooms : '3',
		area : '2640 m2',
		position : {
			lat : -32.89333614367499,
			lng : -68.85274015720825
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Una Casa Sofisticada',
		image : '4-1-thmb.png',
		type : 'Venta',
		price : '$1,930,000',
		address : 'Fifistreet 5478, Merlo, San Luis',
		bedrooms : '3',
		bathrooms : '2',
		area : '2800 m2',
		position : {
			lat : -32.890183,
			lng : -68.8440498
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansión Copada',
		image : '5-1-thmb.png',
		type : 'Alquiler',
		price : '$2,350,000',
		address : 'Eusebio blanco 123, Ciudad, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '2750 m2',
		position : {
			lat : -32.896092800194744,
			lng : -68.84643160160522
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Residencia Moderna en Dalvian',
		image : '1-1-thmb.png',
		type : 'Venta',
		price : '$1,550,000',
		address : 'Calle Falsa 123, Las Heras, Mendoza',
		bedrooms : '3',
		bathrooms : '2',
		area : '3430 m2',
		position : {
			lat : -32.89036318266172,
			lng : -68.84698950108032
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Casa Muy Bonita',
		image : '2-1-thmb.png',
		type : 'Alquiler',
		price : '$1,750,000',
		address : 'Otra Calle 865, Godoy Cruz, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '4430 m2',
		position : {
			lat : -32.887624366658365,
			lng : -68.83872829731445
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansa Mansión',
		image : '3-1-thmb.png',
		type : 'Venta',
		price : '$1,340,000',
		address : 'Ricachon 2365, San Isidro, Buenos Aires',
		bedrooms : '2',
		bathrooms : '3',
		area : '2640 m2',
		position : {
			lat : -32.89182264871652,
			lng : -68.83917890842895
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Una Casa Sofisticada',
		image : '4-1-thmb.png',
		type : 'Venta',
		price : '$1,930,000',
		address : 'Fifistreet 5478, Merlo, San Luis',
		bedrooms : '3',
		bathrooms : '2',
		area : '2800 m2',
		position : {
			lat : -32.890483,
			lng : -68.8447498
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansión Copada',
		image : '5-1-thmb.png',
		type : 'Alquiler',
		price : '$2,350,000',
		address : 'Eusebio blanco 123, Ciudad, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '2750 m2',
		position : {
			lat : -32.891183,
			lng : -68.8430498
		},
		markerIcon : "marker-dot-blue.png"
	}];

	// custom infowindow object
	var infobox = new InfoBox({
		disableAutoPan: false,
		maxWidth: 202,
		pixelOffset: new google.maps.Size(-101, -285),
		zIndex: null,
		boxStyle: {
			background: "url('/bebusca/img/map/infobox-bg.png') no-repeat",
			opacity: 1,
			width: "202px",
			height: "245px"
		},
		closeBoxMargin: "28px 26px 0px 0px",
		closeBoxURL: "",
		infoBoxClearance: new google.maps.Size(1, 1),
		pane: "floatPane",
		enableEventPropagation: false
	});

	// function that adds the markers on map
	var addMarkers = function(props, map) {
		$.each(props, function(i,prop) {
			var latlng = new google.maps.LatLng(prop.position.lat,prop.position.lng);
			var marker = new google.maps.Marker({
				position: latlng,
				'map': map,
				icon: new google.maps.MarkerImage(
					'/bebusca/img/map/' + prop.markerIcon,
					null,
					null,
					null,
					new google.maps.Size(36, 36)
				),
				draggable: false,
				animation: google.maps.Animation.DROP,
			});
			var infoboxContent = '<div class="infoW">' +
									'<div class="propImg">' +
										'<img src="/bebusca/img/estates/' + prop.image + '">' +
										'<div class="propBg">' +
											'<div class="propPrice">' + prop.price + '</div>' +
											'<div class="propType">' + prop.type + '</div>' +
										'</div>' +
									'</div>' +
									'<div class="paWrapper">' +
										'<div class="propTitle">' + prop.title + '</div>' +
										'<div class="propAddress">' + prop.address + '</div>' +
									'</div>' +
									'<div class="propRating">' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star-o"></span>' +
									'</div>' +
									'<ul class="propFeat">' +
										'<li><span class="fa fa-moon-o"></span> ' + prop.bedrooms + '</li>' +
										'<li><span class="icon-drop"></span> ' + prop.bathrooms + '</li>' +
										'<li><span class="icon-frame"></span> ' + prop.area + '</li>' +
									'</ul>' +
									'<div class="clearfix"></div>' +
									'<div class="infoButtons">' +
										'<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Cerrar</a>' +
										'<a href="/propiedad" class="btn btn-sm btn-round btn-green viewInfo">Ver</a>' +
									'</div>' +
								'</div>';

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infobox.setContent(infoboxContent);
					infobox.open(map, marker);
				}
			})(marker, i));

			$(document).on('click', '.closeInfo', function() {
				infobox.open(null,null);
			});

			marker.setMap(map);

			markers.push(marker);
		});
	}

	window.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	addMarkers(props,map)

	var coords = [];

	var editable_region = new google.maps.Polygon({
		path: coords,
		fillColor: "#ff3300",
		fillOpacity: 0.2,
		strokeColor: "#ff3300",
		editable: true
	});

	google.maps.event.addListener(map, 'click', function(ev){
		var lat = ev.latLng.lat();
		var lng = ev.latLng.lng();
		update_region(lat,lng);
	});

	google.maps.event.addListener(editable_region,'dragend',function(ev){
		console.log('draend')
	})

	var drawing = false;
	function setDrawing(b){
		drawing = b;
		if(b){
			$('#draw-editable-region').html('<span class="fa fa-pencil c-white icon-left"></span>&nbsp;Dejar de dibujar')
		}else{
			$('#draw-editable-region').html('<span class="fa fa-pencil c-white icon-left"></span>&nbsp;Dibujar zona')
		}
	}

	function update_region(lat,lng){
		if(drawing){
			coords.push(new google.maps.LatLng(lat,lng));
			editable_region.setPath(coords);
			editable_region_changed();
			var editable_region_path = editable_region.getPath()
			google.maps.event.addListener(editable_region_path, 'set_at', editable_region_changed);
			google.maps.event.addListener(editable_region_path, 'insert_at', editable_region_changed);
		}
	}

	var changing = false;
	function editable_region_changed(){
		if(!changing){
			changing = true;
			var d = new Date();
			setTimeout(function(){get_data(d)}, 2100)
		}
	}

	function get_data(d){
		console.log('Hace %d milisegundos el usuario cambio el bicho. Traigamos la data!',new Date() - d);
		changing = false;
	}

	editable_region.setMap(map);

	//listener toggle draw editable region
	$('#draw-editable-region').click(function(){
		(drawing) ? setDrawing(false) : setDrawing(true);
	})

	//listener delete editable region
	$('#delete-editable-region').click(function(){
		coords = [];
		editable_region.setPath([]);
		setDrawing(false);
	})

	var SearchBox = function(){
		var inp = document.querySelector('.input--map-search')
		var searchBox = new google.maps.places.SearchBox(inp);

		google.maps.event.addListener(searchBox, 'places_changed', function(ev) {
			var places = searchBox.getPlaces();
			if (places.length == 0) {
				return;
			}
			map.panTo(places[0].geometry.location)
			console.log(searchBox);
		})
	}

	SearchBox();

	var rad = function(x) {
		return x * Math.PI / 180;
	};

	var getDistance = function(p1, p2) {
		var R = 6378.137; // Earth’s mean radius in meter
		var dLat = rad(p2.lat() - p1.lat());
		var dLong = rad(p2.lng() - p1.lng());
		var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
			Math.sin(dLong / 2) * Math.sin(dLong / 2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		var d = R * c;
		return d; // returns the distance in meter
	};

	window.verticalDistance = function(){
		var p = new google.maps.Data.Point({
			lat: map.getBounds().getCenter().lat(),
			lng: map.getBounds().getNorthEast().lng(),
		})
		return getDistance( p.get() , map.getBounds().getCenter() )
	}

	window.horizontalDistance = function(){
		var p = new google.maps.Data.Point({
			lat: map.getBounds().getNorthEast().lat(),
			lng: map.getBounds().getCenter().lng(),
		})
		return getDistance( p.get() , map.getBounds().getCenter() )
	}

	window.getMinorDistance = function(){
		return(horizontalDistance() < verticalDistance()) ? horizontalDistance() : verticalDistance();
	}

})(jQuery);

/*(function($) {
	"use strict";

	// Custom options for map
	var options = {
			zoom : 14,
			mapTypeId : 'Styled',
			disableDefaultUI: true,
			mapTypeControlOptions : {
				mapTypeIds : [ 'Styled' ]
			}
		};
	var styles = [{
		stylers : [ {
			hue : "#fff"
		}, {
			// saturation : -100
		}]
	}, {
		featureType : "road",
		elementType : "geometry",
		stylers : [ {
			lightness : 100
		}, {
			visibility : "simplified"
		}]
	}, {
		featureType : "road",
		elementType : "labels",
		stylers : [ {
			visibility : "on"
		}]
	}, {
		featureType: "poi",
		stylers: [ {
			visibility: "off"
		}]
	}];

	var newMarker = null;
	var markers = [];

	// json for properties markers on map
	var props = [{
		title : 'Residencia Moderna en Dalvian',
		image : '1-1-thmb.png',
		type : 'Venta',
		price : '$1,550,000',
		address : 'Calle Falsa 123, Las Heras, Mendoza',
		bedrooms : '3',
		bathrooms : '2',
		area : '3430 m2',
		position : {
			lat : -32.8843989418938,
			lng : -68.84862028416137
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Casa Muy Bonita',
		image : '2-1-thmb.png',
		type : 'Alquiler',
		price : '$1,750,000',
		address : 'Otra Calle 865, Godoy Cruz, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '4430 m2',
		position : {
			lat : -32.88895774818249,
			lng : -68.85443531330566
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansa Mansión',
		image : '3-1-thmb.png',
		type : 'Venta',
		price : '$1,340,000',
		address : 'Ricachon 2365, San Isidro, Buenos Aires',
		bedrooms : '2',
		bathrooms : '3',
		area : '2640 m2',
		position : {
			lat : -32.89333614367499,
			lng : -68.85274015720825
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Una Casa Sofisticada',
		image : '4-1-thmb.png',
		type : 'Venta',
		price : '$1,930,000',
		address : 'Fifistreet 5478, Merlo, San Luis',
		bedrooms : '3',
		bathrooms : '2',
		area : '2800 m2',
		position : {
			lat : -32.890183,
			lng : -68.8440498
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansión Copada',
		image : '5-1-thmb.png',
		type : 'Alquiler',
		price : '$2,350,000',
		address : 'Eusebio blanco 123, Ciudad, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '2750 m2',
		position : {
			lat : -32.896092800194744,
			lng : -68.84643160160522
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Residencia Moderna en Dalvian',
		image : '1-1-thmb.png',
		type : 'Venta',
		price : '$1,550,000',
		address : 'Calle Falsa 123, Las Heras, Mendoza',
		bedrooms : '3',
		bathrooms : '2',
		area : '3430 m2',
		position : {
			lat : -32.89036318266172,
			lng : -68.84698950108032
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Casa Muy Bonita',
		image : '2-1-thmb.png',
		type : 'Alquiler',
		price : '$1,750,000',
		address : 'Otra Calle 865, Godoy Cruz, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '4430 m2',
		position : {
			lat : -32.887624366658365,
			lng : -68.83872829731445
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansa Mansión',
		image : '3-1-thmb.png',
		type : 'Venta',
		price : '$1,340,000',
		address : 'Ricachon 2365, San Isidro, Buenos Aires',
		bedrooms : '2',
		bathrooms : '3',
		area : '2640 m2',
		position : {
			lat : -32.89182264871652,
			lng : -68.83917890842895
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Una Casa Sofisticada',
		image : '4-1-thmb.png',
		type : 'Venta',
		price : '$1,930,000',
		address : 'Fifistreet 5478, Merlo, San Luis',
		bedrooms : '3',
		bathrooms : '2',
		area : '2800 m2',
		position : {
			lat : -32.890483,
			lng : -68.8447498
		},
		markerIcon : "marker-dot-blue.png"
	}, {
		title : 'Mansión Copada',
		image : '5-1-thmb.png',
		type : 'Alquiler',
		price : '$2,350,000',
		address : 'Eusebio blanco 123, Ciudad, Mendoza',
		bedrooms : '2',
		bathrooms : '2',
		area : '2750 m2',
		position : {
			lat : -32.891183,
			lng : -68.8430498
		},
		markerIcon : "marker-dot-blue.png"
	}];

	// custom infowindow object
	var infobox = new InfoBox({
		disableAutoPan: false,
		maxWidth: 202,
		pixelOffset: new google.maps.Size(-101, -285),
		zIndex: null,
		boxStyle: {
			background: "url('/bebusca/img/infobox-bg.png') no-repeat",
			opacity: 1,
			width: "202px",
			height: "245px"
		},
		closeBoxMargin: "28px 26px 0px 0px",
		closeBoxURL: "",
		infoBoxClearance: new google.maps.Size(1, 1),
		pane: "floatPane",
		enableEventPropagation: false
	});

	// function that adds the markers on map
	var addMarkers = function(props, map) {
		$.each(props, function(i,prop) {
			var latlng = new google.maps.LatLng(prop.position.lat,prop.position.lng);
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: new google.maps.MarkerImage(
					'/bebusca/img/' + prop.markerIcon,
					null,
					null,
					null,
					new google.maps.Size(36, 36)
				),
				draggable: false,
				animation: google.maps.Animation.DROP,
			});
			var infoboxContent = '<div class="infoW">' +
									'<div class="propImg">' +
										'<img src="/bebusca/img/estates/' + prop.image + '">' +
										'<div class="propBg">' +
											'<div class="propPrice">' + prop.price + '</div>' +
											'<div class="propType">' + prop.type + '</div>' +
										'</div>' +
									'</div>' +
									'<div class="paWrapper">' +
										'<div class="propTitle">' + prop.title + '</div>' +
										'<div class="propAddress">' + prop.address + '</div>' +
									'</div>' +
									'<div class="propRating">' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star"></span>' +
										'<span class="fa fa-star-o"></span>' +
									'</div>' +
									'<ul class="propFeat">' +
										'<li><span class="fa fa-moon-o"></span> ' + prop.bedrooms + '</li>' +
										'<li><span class="icon-drop"></span> ' + prop.bathrooms + '</li>' +
										'<li><span class="icon-frame"></span> ' + prop.area + '</li>' +
									'</ul>' +
									'<div class="clearfix"></div>' +
									'<div class="infoButtons">' +
										'<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Cerrar</a>' +
										'<a href="/propiedad" class="btn btn-sm btn-round btn-green viewInfo">Ver</a>' +
									'</div>' +
								'</div>';

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infobox.setContent(infoboxContent);
					infobox.open(map, marker);
				}
			})(marker, i));

			$(document).on('click', '.closeInfo', function() {
				infobox.open(null,null);
			});

			markers.push(marker);
		});
	}

	var map;
	var windowHeight;
	var windowWidth;
	var contentHeight;
	var contentWidth;
	var isDevice = true;

	setTimeout(function() {
		$('body').removeClass('notransition');

		map = new google.maps.Map(document.getElementById('map'), options);
		// var styledMapType = new google.maps.StyledMapType(styles, {
		// 	name : 'Styled'
		// });

		// map.mapTypes.set('Styled', styledMapType);
		map.setCenter(new google.maps.LatLng(-32.890183,-68.8440498));
		map.setZoom(14);

		var coords = [];

		var editable_region = new google.maps.Polygon({
			path: coords,
			fillColor: "#ff3300",
			fillOpacity: 0.2,
			strokeColor: "#ff3300",
			editable: true
		});

		google.maps.event.addListener(map, 'click', function(ev){
			var lat = ev.latLng.lat();
			var lng = ev.latLng.lng();
			update_region(lat,lng);
		});

		google.maps.event.addListener(editable_region,'dragend',function(ev){
			console.log('draend')
		})

		var drawing = false;
		function setDrawing(b){
			drawing = b;
			if(b){
				$('#draw-editable-region').html('Dejar de dibujar<span class="fa fa-pencil c-white icon-right"></span>')
			}else{
				$('#draw-editable-region').html('Dibujar<span class="fa fa-pencil c-white icon-right"></span>')
			}
		}

		function update_region(lat,lng){
			if(drawing){
				coords.push(new google.maps.LatLng(lat,lng));
				editable_region.setPath(coords);
				editable_region_changed();
				var editable_region_path = editable_region.getPath()
				google.maps.event.addListener(editable_region_path, 'set_at', editable_region_changed);
				google.maps.event.addListener(editable_region_path, 'insert_at', editable_region_changed);
			}
		}

		var changing = false;
		function editable_region_changed(){
			if(!changing){
				changing = true;
				var d = new Date();
				setTimeout(function(){get_data(d)}, 2100)
			}
		}

		function get_data(d){
			console.log('Hace %d milisegundos el usuario cambio el bicho. Traigamos la data!',new Date() - d);
			changing = false;
		}

		editable_region.setMap(map);

		//listener toggle draw editable region
		$('#draw-editable-region').click(function(){
			(drawing) ? setDrawing(false) : setDrawing(true);
		})

		//listener delete editable region
		$('#delete-editable-region').click(function(){
			coords = [];
			editable_region.setPath([]);
			setDrawing(false);
		})

		if ($('#address').length > 0) {
			newMarker = new google.maps.Marker({
				position: new google.maps.LatLng(-32.890183,-68.8440498),
				map: map,
				icon: new google.maps.MarkerImage(
					LocalVar.markerNew,
					null,
					null,
					// new google.maps.Point(0,0),
					null,
					new google.maps.Size(36, 36)
				),
				draggable: true,
				animation: google.maps.Animation.DROP,
			});

			google.maps.event.addListener(newMarker, "mouseup", function(event) {
				var latitude = this.position.lat();
				var longitude = this.position.lng();
				$('#latitude').text(this.position.lat());
				$('#longitude').text(this.position.lng());
			});
		}

		addMarkers(props, map);
	}, 300);

})(jQuery);*/
jQuery(document).ready(function(){
	$('.btn-rb-switch').on('click', toggleActive);
	function toggleActive(){
		$(this).toggleClass('active');
	}

	$('.filter-more').on('click', showMoreFilters);
	function showMoreFilters(){
		$('.filter-more .dropdown-menu').first().addClass('show');
	}
	function hideMoreFilters(){
		$('.filter-more .dropdown-menu').first().removeClass('show');
	}

	$('body').on('click',function (e){
		var container = $('.filter-more').first();

		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			hideMoreFilters();
		}
	});
})