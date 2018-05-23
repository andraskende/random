<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Search', 'http://www.kende.com/search'); ?>

<?php if($map): ?>

	<div id="mapcontainer"><div id="mapcanvas"></div></div>

	<script type="text/javascript">

		var gmarkers = [];

		var infowindow = new google.maps.InfoWindow();

		function initialize(){
			var myOptions = {
				scaleControl: true,
				scrollwheel: false,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DEFAULT},
				navigationControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
			var northEast = new google.maps.LatLng(<?php echo $maxlat; ?>, <?php echo $maxlng; ?>);
			var southWest = new google.maps.LatLng(<?php echo $minlat; ?>, <?php echo $minlng; ?>);
			var bounds = new google.maps.LatLngBounds(southWest, northEast);
			map.fitBounds(bounds);
			var i = 0;
			$(".r").each(function() {
				$("td:eq(0)", $(this)).html('<div class="map" id="ms_'+i+'"></div>');
				var geo = $(this).attr('data-map').split('|');
				createMarker(geo[0], geo[1], '<strong>'+$("td:eq(1)", $(this)).html()+'</strong><br />'+$("td:eq(2)", $(this)).html()+'<br /><a href="http://maps.google.com/maps?daddr='+$("td:eq(2)", $(this)).html()+'&z=10" target="_blank">Get Directions</a><br /><br />'+$("td:eq(3)", $(this)).html()+'');
				i += 1;
			});
			google.maps.event.addListener(map, "dragend", function() {
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

		function infomap(i){
			google.maps.event.trigger(gmarkers[i], 'mouseover');
		}

		$(document).ready(function(){
			initialize();
			$('#mapresult').on('mouseover', '.map', function(){
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
				$("#s").val(ui.item.label);
				// $("#searchform").submit();
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
		<?php echo $this->Form->input('distance', array('class' => 'form-control', 'type' => 'select', 'options' => array(5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500), 'default' => $distance)); ?>
	</div>
	<div class="col-sm-1">
		<?php echo $this->Form->input('unit', array('class' => 'form-control', 'type' => 'select', 'options' => array('m' => 'mi', 'km' => 'km'), 'default' => $unit)); ?>
	</div>
	<div class="col-sm-3">
		<br />
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span> Search', array('div' => false, 'class' => 'btn btn-primary')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<br />

<?php if(!empty($search)) : ?>
	<?php if(!empty($locations)) : ?>
		<br />
		<?php $i = 0; ?>
		<table class="table-striped table-bordered table-condensed table-hover" id="mapresult">
			<?php foreach ($locations as $location): ?>
			<tr<?php if($location->lat != 0) : ?> class="r" data-map="<?php echo $location->lat; ?>|<?php echo $location->lng; ?>"<?php endif; ?>>
				<td></td>
				<td><?php echo $this->Html->link($location->name, array('controller' => 'Locations', 'action' => 'view', 'slug' => $location->slug)); ?></td>
				<td><?php echo $location->address; ?> <?php echo $location->city; ?>, <?php echo $location->state; ?>, <?php echo $location->postal_code; ?></td>
				<td><?php echo $location->phone; ?></td>
				<?php if(isset($location->distance)) : ?>
				<td><?php echo $location->distance; ?> <?php echo ($unit == 'm') ? 'Miles' : 'km' ; ?></td>
				<?php endif; ?>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php else: ?>
		<div class="m">No Results</div>
	<?php endif; ?>
<?php endif; ?>
