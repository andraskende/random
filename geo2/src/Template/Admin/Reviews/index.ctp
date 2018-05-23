<div class="reviews index">
	<h2><?= __('Reviews') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('location_id') ?></th>
		<th><?= $this->Paginator->sort('name') ?></th>
		<th><?= $this->Paginator->sort('email') ?></th>
		<th><?= $this->Paginator->sort('body') ?></th>
		<th><?= $this->Paginator->sort('ip_address') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($reviews as $review): ?>
	<tr>
		<td><?= h($review->id) ?>&nbsp;</td>
		<td><?= h($review->location_id) ?>&nbsp;</td>
		<td><?= h($review->name) ?>&nbsp;</td>
		<td><?= h($review->email) ?>&nbsp;</td>
		<td><?= h($review->body) ?>&nbsp;</td>
		<td><?= h($review->ip_address) ?>&nbsp;</td>
		<td><?= h($review->active) ?>&nbsp;</td>
		<td><?= h($review->created) ?>&nbsp;</td>
		<td><?= h($review->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $review->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $review->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?>
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
		<li><?= $this->Html->link(__('New Review'), ['action' => 'add']) ?></li>
	</ul>
</div>
