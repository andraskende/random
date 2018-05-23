<div class="contacts form">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Add Contact'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('notes');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?></li>
	</ul>
</div>
