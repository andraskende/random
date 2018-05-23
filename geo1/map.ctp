<h3><?php echo $location; ?></h3>

<?= $this->Html->link('Cities', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

<br />
<br />

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"
  type="text/javascript"></script>


<div id="map" style="width: 600px; height: 600px;"></div>

  <script type="text/javascript">
    var locations = <?php echo $locations; ?>;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i]['city']);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>


<br />
<br />

<?php $c = 0; ?>

<table class="table table-nonfluid table-striped table-bordered table-condensed table-hover noblue"
    <thead>
        <tr>
            <th>#</th>
            <th>city</th>
            <th>latitude</th>
            <th>longitude</th>
            <th>distance</th>
            <th>actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cities as $city): ?>
        <tr>
            <td><?php echo ++$c; ?></td>
            <td><?= h($city->city) ?></td>
            <td><?= h($city->latitude) ?></td>
            <td><?= h($city->longitude) ?></td>
            <td><?= h($city->distance) ?></td>
            <td class="actions">
                <?= $this->Html->link('Map', ['action' => 'map', '?' => [
                    'location' => $city->city,
                    'latitude' => $city->latitude,
                    'longitude' => $city->longitude,
                    'distance' => 60,
                ]], ['class' => '']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br />
<br />
