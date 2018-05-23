<div class="reviews form">
<?= $this->Form->create($review) ?>
	<fieldset>
		<legend><?= __('Edit Review'); ?></legend>
	<?php
		echo $this->Form->input('location_id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('body');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # %s?', $review->id)]) ?></li>
		<li><?= $this->Html->link(__('List Reviews'), ['action' => 'index']) ?></li>
	</ul>
</div>
