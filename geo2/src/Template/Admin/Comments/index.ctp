<div class="comments index">
	<h2><?= __('Comments') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('name') ?></th>
		<th><?= $this->Paginator->sort('phone') ?></th>
		<th><?= $this->Paginator->sort('email') ?></th>
		<th><?= $this->Paginator->sort('message') ?></th>
		<th><?= $this->Paginator->sort('memo') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('referer') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($comments as $comment): ?>
	<tr>
		<td><?= h($comment->id) ?>&nbsp;</td>
		<td><?= h($comment->name) ?>&nbsp;</td>
		<td><?= h($comment->phone) ?>&nbsp;</td>
		<td><?= h($comment->email) ?>&nbsp;</td>
		<td><?= h($comment->message) ?>&nbsp;</td>
		<td><?= h($comment->memo) ?>&nbsp;</td>
		<td><?= h($comment->active) ?>&nbsp;</td>
		<td><?= h($comment->referer) ?>&nbsp;</td>
		<td><?= h($comment->created) ?>&nbsp;</td>
		<td><?= h($comment->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $comment->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $comment->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
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
		<li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?></li>
	</ul>
</div>
