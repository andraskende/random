<div class="registrations index">
	<h2><?= __('Registrations') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('user_id') ?></th>
		<th><?= $this->Paginator->sort('event_id') ?></th>
		<th><?= $this->Paginator->sort('location_id') ?></th>
		<th><?= $this->Paginator->sort('play_as') ?></th>
		<th><?= $this->Paginator->sort('price') ?></th>
		<th><?= $this->Paginator->sort('memo') ?></th>
		<th><?= $this->Paginator->sort('status') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($registrations as $registration): ?>
	<tr>
		<td><?= h($registration->id) ?>&nbsp;</td>
		<td>
			<?= $registration->has('user') ? $this->Html->link($registration->user->name, ['controller' => 'Users', 'action' => 'view', $registration->user->id]) : '' ?>
		</td>
		<td>
			<?= $registration->has('event') ? $this->Html->link($registration->event->id, ['controller' => 'Events', 'action' => 'view', $registration->event->id]) : '' ?>
		</td>
		<td>
			<?= $registration->has('location') ? $this->Html->link($registration->location->name, ['controller' => 'Locations', 'action' => 'view', $registration->location->id]) : '' ?>
		</td>
		<td><?= h($registration->play_as) ?>&nbsp;</td>
		<td><?= h($registration->price) ?>&nbsp;</td>
		<td><?= h($registration->memo) ?>&nbsp;</td>
		<td><?= h($registration->status) ?>&nbsp;</td>
		<td><?= h($registration->active) ?>&nbsp;</td>
		<td><?= h($registration->created) ?>&nbsp;</td>
		<td><?= h($registration->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $registration->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $registration->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id)]) ?>
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
		<li><?= $this->Html->link(__('New Registration'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
	</ul>
</div>
