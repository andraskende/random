<div class="comments form">
<?= $this->Form->create($comment) ?>
	<fieldset>
		<legend><?= __('Edit Comment'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('message');
		echo $this->Form->input('memo');
		echo $this->Form->input('active');
		echo $this->Form->input('referer');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # %s?', $comment->id)]) ?></li>
		<li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
	</ul>
</div>
