<h2><?= __('Edit Contact'); ?></h2>

	<?= $this->Form->create($contact) ?>

	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('notes');
		echo $this->Form->input('active');
	?>

	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
