<div class="reviews view">
	<h2><?= __('Review') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($review->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Location Id') ?></dt>
		<dd>
			<?= h($review->location_id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Name') ?></dt>
		<dd>
			<?= h($review->name) ?>
			&nbsp;
		</dd>
		<dt><?= __('Email') ?></dt>
		<dd>
			<?= h($review->email) ?>
			&nbsp;
		</dd>
		<dt><?= __('Body') ?></dt>
		<dd>
			<?= h($review->body) ?>
			&nbsp;
		</dd>
		<dt><?= __('Ip Address') ?></dt>
		<dd>
			<?= h($review->ip_address) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($review->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($review->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($review->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Review'), ['action' => 'edit', $review->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Review'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # %s?', $review->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Reviews'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Review'), ['action' => 'add']) ?> </li>
	</ul>
</div>
