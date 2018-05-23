<h3>Cities</h3>

<?= $this->Html->link('Cities', ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

<br />
<br />

<?php echo $this->element('pagination'); ?>

<br />

<table class="table table-nonfluid table-striped table-bordered table-condensed table-hover noblue"
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('city') ?></th>
            <th><?= $this->Paginator->sort('latitude') ?></th>
            <th><?= $this->Paginator->sort('longitude') ?></th>
            <th>actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cities as $city): ?>
        <tr>
            <td><?= h($city->city) ?></td>
            <td><?= $this->Number->format($city->latitude) ?></td>
            <td><?= $this->Number->format($city->longitude) ?></td>
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

<?php echo $this->element('pagination'); ?>

<br />
<br />