<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Search', 'http://www.kende.com/search'); ?>

<?php if($map): ?>

	<script type="text/javascript">

		var gmarkers = [];
		var infowindow = new google.maps.InfoWindow();

		function initialize(){

			$("#mapcanvas").hide();

			var myLatlng = new google.maps.LatLng(34.1812, -118.445);

			var myOptions = {
				scaleControl: true,
				zoom: 14,
				center: myLatlng,
				scrollwheel: false,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DEFAULT},
				navigationControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

			liveupdate();

			google.maps.event.addListener(map, "dragend", function() {
				$('#lat').val(map.getCenter().lat());
				$('#lng').val(map.getCenter().lng());
				liveupdate();
			});
		}

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
			var lat = $('#lat').val();
			var lng = $('#lng').val();
			var distance = $('#distance').val();
			var unit = $('#unit').val();
			if(map.getBounds() == null){
				var swlat = 0;
				var swlng = 0;
				var nelat = 0;
				var nelng = 0;
			} else {
				var swlat = map.getBounds().getSouthWest().lat();
				var swlng = map.getBounds().getSouthWest().lng();
				var nelat = map.getBounds().getNorthEast().lat();
				var nelng = map.getBounds().getNorthEast().lng();
			}

			$('#mapresult').html('');
			$.ajax({
				type: "GET",
				async: false,
				url: "/locations/liveupdate",
				dataType: "json",
				data: ({
					'nelat' : nelat,
					'nelng' : nelng,
					'swlat' : swlat,
					'swlng' : swlng,
					'lat' : lat,
					'lng' : lng,
					'name' : name,
					'distance' : distance,
					'unit' : unit
				}),
				success: function(data){
					clearOverlays();
					var tabledata = '';

					// for (var i in data) {
					for (i = 0; i < data.length; i++) {
						if (data.hasOwnProperty(i)) {
							createMarker(data[i].lat, data[i].lng, '<strong>' + data[i].name + '</strong>', i);
							tabledata += '<tr><td><div class="maps m_'+i+'" id="m_'+i+'"></div></td><td><a href="/rink/' + data[i].slug+ '">' + data[i].name + '</a></td><td>' + data[i].address + ', ' +  data[i].city + ' ' +  data[i].state + ' ' +  data[i].postal_code + '</td><td>' + data[i].phone + '</td><td>' + data[i].distance + ' ' + unit +  '</td></tr>';
						}
					}
					$('#mapresult').html(tabledata);

					if($('#initial').val() == 1) {
						var bounds = 0;
						var latlngbounds = new google.maps.LatLngBounds();
						for (var i in data) {
							if (data.hasOwnProperty(i)) {
								latlng = new google.maps.LatLng(data[i].lat, data[i].lng);
								latlngbounds.extend(latlng);
								bounds = 1;
							}
						}
						if(bounds) {
							map.fitBounds(latlngbounds);
							$("#mapcanvas").show();
						}

					}
					$('#initial').val('0');

				}
			});
		}

		function createMarker(lat, lng, content, i){
			var latlng = new google.maps.LatLng(lat, lng);
			var i1 = i * 25;
			var icon = {
				url: 'http://www.kende.com/img/spriteicons.png',
				size: new google.maps.Size(25, 25),
				origin: new google.maps.Point(i1, 0),
				anchor: new google.maps.Point(0, 0)
			};
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: icon
			});
			google.maps.event.addListener(marker, 'mouseover', function(){
				infowindow.setContent(content);
				infowindow.open(map, marker);
			});
			gmarkers.push(marker);
		}

		function infomap(i){
			console.log(gmarkers);
			google.maps.event.trigger(gmarkers[i], 'mouseover');
		}

		$(document).ready(function(){
			initialize();
			$('#mapresult').on('mouseover', '.maps', function(){
				var t = $(this).attr('id').split('_');
				infomap(t[1]);
			});
		});

	</script>

<?php endif; ?>

<script type="text/javascript">

	$(document).ready(function(){

		autocomplete = new google.maps.places.Autocomplete(
			(document.getElementById('loc')),
			{ types: ['geocode'] }
		);

		var cache = {};
		$( "#name" ).autocomplete({
			minLength: 1,
			select: function(event, ui) {
				$("#name").val(ui.item.label);
			},
			source: function(request, response) {
				var term = request.term;
				if(term in cache) {
					response($.map(cache[term], function(el, index) {
						return {
							value: el.name,
							title: el.name,
							city: el.city,
							state: el.state
						};
					}));
					return;
				}
				$.getJSON( "/locations/autocomplete", request, function(data, status, xhr) {
					cache[term] = data;
					response($.map(data, function(el, index) {
						return {
							value: el.name,
							title: el.name,
							city: el.city,
							state: el.state
						};
					}));
				});
			}
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.append( "<a style='font-size:14px'>" + item.value + " - " + item.city + ", " + item.state + "</a>" )
			.appendTo(ul);
		};

	});

</script>

<h1>Search</h1>

<?php echo $this->Form->create(null, array('type' => 'get')); ?>
<div class="row">
	<div class="col-sm-3">
		<?php echo $this->Form->input('name', array('class' => 'form-control', 'div' => false, 'placeholder' => 'Ex: Rink Name', 'required' =>  false, 'value' => $name)); ?>
	</div>
	<div class="col-sm-3">
		<?php echo $this->Form->input('loc', array('class' => 'form-control', 'div' => false, 'type' => 'text', 'label' => 'Location', 'required' =>  false, 'placeholder' => 'Ex: Los Angeles', 'value' => $loc)); ?>
	</div>
	<div class="col-sm-2">
		<?php echo $this->Form->input('distance', array('class' => 'form-control', 'type' => 'select', 'options' => array(10 => 10, 25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500), 'default' => $distance)); ?>
	</div>
	<div class="col-sm-1">
		<?php echo $this->Form->input('unit', array('class' => 'form-control', 'type' => 'select', 'options' => array('m' => 'Miles', 'km' => 'Kilometers'), 'default' => $unit)); ?>
	</div>
	<div class="col-sm-3">
		<br />
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span> Search', array('div' => false, 'class' => 'btn btn-primary')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<br />

<div id="mapcanvas"></div>

<br />

<table class="table-striped table-bordered table-condensed table-hover" id="mapresult"></table>

<input type="hidden" id="lat" value="<?php echo $lat; ?>" />
<input type="hidden" id="lng" value="<?php echo $lng; ?>" />
<input type="hidden" id="distance" value="<?php echo $distance; ?>" />
<input type="hidden" id="initial" value="1" />


