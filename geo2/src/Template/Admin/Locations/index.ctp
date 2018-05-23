<div class="locations index">
	<h2><?= __('Locations') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('placeid') ?></th>
		<th><?= $this->Paginator->sort('name') ?></th>
		<th><?= $this->Paginator->sort('slug') ?></th>
		<th><?= $this->Paginator->sort('description') ?></th>
		<th><?= $this->Paginator->sort('formatted_address') ?></th>
		<th><?= $this->Paginator->sort('reference') ?></th>
		<th><?= $this->Paginator->sort('vicinity') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('response') ?></th>
		<th><?= $this->Paginator->sort('phone') ?></th>
		<th><?= $this->Paginator->sort('address') ?></th>
		<th><?= $this->Paginator->sort('city') ?></th>
		<th><?= $this->Paginator->sort('state') ?></th>
		<th><?= $this->Paginator->sort('postal_code') ?></th>
		<th><?= $this->Paginator->sort('lat') ?></th>
		<th><?= $this->Paginator->sort('lng') ?></th>
		<th><?= $this->Paginator->sort('views') ?></th>
		<th><?= $this->Paginator->sort('email') ?></th>
		<th><?= $this->Paginator->sort('website') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($locations as $location): ?>
	<tr>
		<td><?= h($location->id) ?>&nbsp;</td>
		<td><?= h($location->placeid) ?>&nbsp;</td>
		<td><?= h($location->name) ?>&nbsp;</td>
		<td><?= h($location->slug) ?>&nbsp;</td>
		<td><?= h($location->description) ?>&nbsp;</td>
		<td><?= h($location->formatted_address) ?>&nbsp;</td>
		<td><?= h($location->reference) ?>&nbsp;</td>
		<td><?= h($location->vicinity) ?>&nbsp;</td>
		<td><?= h($location->active) ?>&nbsp;</td>
		<td><?= h($location->response) ?>&nbsp;</td>
		<td><?= h($location->phone) ?>&nbsp;</td>
		<td><?= h($location->address) ?>&nbsp;</td>
		<td><?= h($location->city) ?>&nbsp;</td>
		<td><?= h($location->state) ?>&nbsp;</td>
		<td><?= h($location->postal_code) ?>&nbsp;</td>
		<td><?= h($location->lat) ?>&nbsp;</td>
		<td><?= h($location->lng) ?>&nbsp;</td>
		<td><?= h($location->views) ?>&nbsp;</td>
		<td><?= h($location->email) ?>&nbsp;</td>
		<td><?= h($location->website) ?>&nbsp;</td>
		<td><?= h($location->created) ?>&nbsp;</td>
		<td><?= h($location->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $location->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $location->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $location->id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->id)]) ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p><?= $this->Paginator->counter() ?></p>
	<ul class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'));
		echo $this->Paginator->numbers();
		echo $this->Paginator->next(__('next') . ' >');
	?>
	</ul>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?></li>
	</ul>
</div>
