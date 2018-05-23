<div class="events view">
	<h2><?= __('Event') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($event->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('User') ?></dt>
		<dd>
			<?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?>
			&nbsp;
		</dd>
		<dt><?= __('Location') ?></dt>
		<dd>
			<?= $event->has('location') ? $this->Html->link($event->location->name, ['controller' => 'Locations', 'action' => 'view', $event->location->id]) : '' ?>
			&nbsp;
		</dd>
		<dt><?= __('Start Date') ?></dt>
		<dd>
			<?= h($event->start_date) ?>
			&nbsp;
		</dd>
		<dt><?= __('End Date') ?></dt>
		<dd>
			<?= h($event->end_date) ?>
			&nbsp;
		</dd>
		<dt><?= __('Timezone') ?></dt>
		<dd>
			<?= h($event->timezone) ?>
			&nbsp;
		</dd>
		<dt><?= __('Privacy') ?></dt>
		<dd>
			<?= h($event->privacy) ?>
			&nbsp;
		</dd>
		<dt><?= __('Capacity') ?></dt>
		<dd>
			<?= h($event->capacity) ?>
			&nbsp;
		</dd>
		<dt><?= __('Price') ?></dt>
		<dd>
			<?= h($event->price) ?>
			&nbsp;
		</dd>
		<dt><?= __('Description') ?></dt>
		<dd>
			<?= h($event->description) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($event->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($event->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($event->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # %s?', $event->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?= __('Related Registrations') ?></h3>
	<?php if (!empty($event->registrations)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Location Id') ?></th>
			<th><?= __('Play As') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Memo') ?></th>
			<th><?= __('Status') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($event->registrations as $registrations): ?>
		<tr>
			<td><?= h($registrations->id) ?></td>
			<td><?= h($registrations->user_id) ?></td>
			<td><?= h($registrations->event_id) ?></td>
			<td><?= h($registrations->location_id) ?></td>
			<td><?= h($registrations->play_as) ?></td>
			<td><?= h($registrations->price) ?></td>
			<td><?= h($registrations->memo) ?></td>
			<td><?= h($registrations->status) ?></td>
			<td><?= h($registrations->active) ?></td>
			<td><?= h($registrations->created) ?></td>
			<td><?= h($registrations->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Registrations', 'action' => 'view', $registrations->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Registrations', 'action' => 'edit', $registrations->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Registrations', 'action' => 'delete', $registrations->id], ['confirm' => __('Are you sure you want to delete # %s?', $registrations->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
		</ul>
	</div>
</div>
