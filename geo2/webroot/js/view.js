$(document).ready(function() {

	googleMap();

});

function googleMap() {

	var name = $("#locationname").attr("value");
	var phone = $("#phone").attr("value");
	var lat = $("#lat").attr("value");
	var lng = $("#lng").attr("value");
	var address = $("#address").attr("value");

	var myLatlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
		zoom: 14,
		center: myLatlng,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DEFAULT,
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.SATELLITE]
		},
		scaleControl: true,
		navigationControl: true,
		navigationControlOptions: {
			style: google.maps.NavigationControlStyle.DEFAULT
		}
	}
	var map = new google.maps.Map(document.getElementById("map1"), myOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: name
	});
	var contentString = '<div >'+
	''+
	'<strong>'+name+'</strong><br />'+
	''+address+'<br />'+
	'<a href="http://maps.google.com/maps?daddr='+address+'&z=10" target="_blank">Get Directions</a><br /><br />'+
	''+phone+'<br />'+
	'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		pixelOffset: new google.maps.Size(0, 35)
	});
	infowindow.open(map, marker);
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker);
	});
}

function googleMapStreetView() {

	var name = $("#name").attr("value");
	var lat = $("#lat").attr("value");
	var lng = $("#lng").attr("value");
	var address = $("#address").attr("value");

	var loc = new google.maps.LatLng(lat, lng);

	var panoramaOptions = {
		position: loc,
		pov: {
		heading: 270,
		pitch: 0,
		zoom: 1
		},
		visible: true,
		enableCloseButton: true
	};
	var panorama = new google.maps.StreetViewPanorama(document.getElementById("map1"), panoramaOptions);

}

function googleMapCombined() {

	var name = $("#locationname").attr("value");
	var lat = $("#lat").attr("value");
	var lng = $("#lng").attr("value");
	var address = $("#address").attr("value");

	var loc = new google.maps.LatLng(lat, lng);

	var mapOptions = {
		center: loc,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(
		document.getElementById("map1"), mapOptions);
	var panoramaOptions = {
		position: loc,
		pov: {
			heading: 34,
			pitch: 10,
			zoom: 1
		}
	};
	var panorama = new google.maps.StreetViewPanorama(document.getElementById("map1"),panoramaOptions);
	map.setStreetView(panorama);

};

