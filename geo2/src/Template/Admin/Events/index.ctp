<div class="events index">
	<h2><?= __('Events') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('user_id') ?></th>
		<th><?= $this->Paginator->sort('location_id') ?></th>
		<th><?= $this->Paginator->sort('start_date') ?></th>
		<th><?= $this->Paginator->sort('end_date') ?></th>
		<th><?= $this->Paginator->sort('timezone') ?></th>
		<th><?= $this->Paginator->sort('privacy') ?></th>
		<th><?= $this->Paginator->sort('capacity') ?></th>
		<th><?= $this->Paginator->sort('price') ?></th>
		<th><?= $this->Paginator->sort('description') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?= h($event->id) ?>&nbsp;</td>
		<td>
			<?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?>
		</td>
		<td>
			<?= $event->has('location') ? $this->Html->link($event->location->name, ['controller' => 'Locations', 'action' => 'view', $event->location->id]) : '' ?>
		</td>
		<td><?= h($event->start_date) ?>&nbsp;</td>
		<td><?= h($event->end_date) ?>&nbsp;</td>
		<td><?= h($event->timezone) ?>&nbsp;</td>
		<td><?= h($event->privacy) ?>&nbsp;</td>
		<td><?= h($event->capacity) ?>&nbsp;</td>
		<td><?= h($event->price) ?>&nbsp;</td>
		<td><?= h($event->description) ?>&nbsp;</td>
		<td><?= h($event->active) ?>&nbsp;</td>
		<td><?= h($event->created) ?>&nbsp;</td>
		<td><?= h($event->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $event->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
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
		<li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
	</ul>
</div>
