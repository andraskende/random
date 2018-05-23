<div class="registrations view">
	<h2><?= __('Registration') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($registration->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('User') ?></dt>
		<dd>
			<?= $registration->has('user') ? $this->Html->link($registration->user->name, ['controller' => 'Users', 'action' => 'view', $registration->user->id]) : '' ?>
			&nbsp;
		</dd>
		<dt><?= __('Event') ?></dt>
		<dd>
			<?= $registration->has('event') ? $this->Html->link($registration->event->id, ['controller' => 'Events', 'action' => 'view', $registration->event->id]) : '' ?>
			&nbsp;
		</dd>
		<dt><?= __('Location') ?></dt>
		<dd>
			<?= $registration->has('location') ? $this->Html->link($registration->location->name, ['controller' => 'Locations', 'action' => 'view', $registration->location->id]) : '' ?>
			&nbsp;
		</dd>
		<dt><?= __('Play As') ?></dt>
		<dd>
			<?= h($registration->play_as) ?>
			&nbsp;
		</dd>
		<dt><?= __('Price') ?></dt>
		<dd>
			<?= h($registration->price) ?>
			&nbsp;
		</dd>
		<dt><?= __('Memo') ?></dt>
		<dd>
			<?= h($registration->memo) ?>
			&nbsp;
		</dd>
		<dt><?= __('Status') ?></dt>
		<dd>
			<?= h($registration->status) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($registration->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($registration->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($registration->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Registration'), ['action' => 'edit', $registration->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Registration'), ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete # %s?', $registration->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Registrations'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Registration'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
	</ul>
</div>
