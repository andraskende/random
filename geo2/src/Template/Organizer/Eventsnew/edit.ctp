<div class="events form">
<?= $this->Form->create($event) ?>
	<fieldset>
		<legend><?= __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('user_id', ['options' => $users]);
		echo $this->Form->input('location_id', ['options' => $locations]);
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('timezone');
		echo $this->Form->input('privacy');
		echo $this->Form->input('capacity');
		echo $this->Form->input('price');
		echo $this->Form->input('description');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # %s?', $event->id)]) ?></li>
		<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
	</ul>
</div>
