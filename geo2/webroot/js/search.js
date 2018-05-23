var gmarkers = [];
var map = null;

var infowindow = new google.maps.InfoWindow();

function initialize(){
	var c = $("#coords").attr('value').split('|');
	var minlat = c[0];
	var minlng = c[1];
	var maxlat = c[2];
	var maxlng = c[3];
	var myOptions = {
		zoom: 3,
		scaleControl: true,
		scrollwheel: false,
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DEFAULT},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
	var northEast = new google.maps.LatLng(maxlat, maxlng);
	var southWest = new google.maps.LatLng(minlat, minlng);
	var bounds = new google.maps.LatLngBounds(southWest, northEast);
	map.fitBounds(bounds);
	var i = 0;
	$(".r").each(function() {
		$("td:eq(0)", $(this)).html('<div class="map" id="ms_'+i+'"></div>');
		var geo = $(this).attr('data-map').split('|');
		createMarker(geo[0], geo[1], '<strong>'+$("td:eq(1)", $(this)).html()+'</strong><br />'+$("td:eq(2)", $(this)).html()+'<br /><a href="http://maps.google.com/maps?daddr='+$("td:eq(2)", $(this)).html()+'&z=10" target="_blank">Get Directions</a><br /><br />'+$("td:eq(3)", $(this)).html()+'');
		i += 1;
	});
	google.maps.event.addListener(map, "click", function(){
		infowindow.close();
	});

	google.maps.event.addListener(map, "dragend", function() {
		liveupdate();
	});

	google.maps.event.addListener(map, "zoom_changed", function() {
		// liveupdate();
	});

}

var map;
var gmarkers = [];
var infoWindow;

function clearOverlays() {
	if (gmarkers) {
		for (i in gmarkers) {
			gmarkers[i].setMap(null);
		}
		gmarkers = [];
	}
}

function liveupdate(){

	var name = $('#name').val();
	var unit = $('#unit').val();
	var southWestLat = map.getBounds().getSouthWest().lat();
	var southWestLng = map.getBounds().getSouthWest().lng();
	var northEastLat = map.getBounds().getNorthEast().lat();
	var northEastLng = map.getBounds().getNorthEast().lng();
	var lat = map.getCenter().lat();
	var lng = map.getCenter().lng();

	$('#mapresult').html('');

	$.ajax({
		type: "GET",
		url: "/locations/liveupdate",
		dataType: "json",
		data: ({
			'southWestLat' : southWestLat,
			'southWestLng' : southWestLng,
			'northEastLat' : northEastLat,
			'northEastLng' : northEastLng,
			'lat' : lat,
			'lng' : lng,
			'name' : name,
			'unit' : unit
		}),
		success: function(data){

			clearOverlays();

			var i = 0;
			var tabledata = '';

			for (var id in data){
				if (data.hasOwnProperty(id)){
					createMarker(data[id].lat, data[id].lng, '<strong>' + data[id].name + '</strong>');
					tabledata += '<tr><td><div class="map" id="ms_'+i+'"></div></td><td><a href="/rink/' + data[id].slug+ '">' + data[id].name + '</a></td><td>' + data[id].address + ', ' +  data[id].city + ' ' +  data[id].state + ' ' +  data[id].postal_code + '</td><td>' + data[id].phone + '</td><td>' + data[id].distance + ' ' + unit +  '</td></tr>';
					i += 1;
				}
			}
			$('#mapresult').html(tabledata);
		}
	});
}


function createMarker(lat, lng, content){

	var latlng = new google.maps.LatLng(lat, lng);

	var marker = new google.maps.Marker({
		position: latlng,
		icon: '/img/spotlight-poi.png',
		map: map
	});

	google.maps.event.addListener(marker, 'mouseover', function(){
		infowindow.setContent(content);
		infowindow.open(map, marker);
	});

	gmarkers.push(marker);

}

function info(i){
	google.maps.event.trigger(gmarkers[i], 'mouseover');
}

$(document).ready(function(){

	initialize();

	$('#mapresult').on('mouseover', '.map', function(){
		var t = $(this).attr('id').split('_');
		info(t[1]);
	});

});
