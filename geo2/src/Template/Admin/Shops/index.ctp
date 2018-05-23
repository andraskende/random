<div class="shops index">
	<h2><?= __('Shops') ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id') ?></th>
		<th><?= $this->Paginator->sort('name') ?></th>
		<th><?= $this->Paginator->sort('slug') ?></th>
		<th><?= $this->Paginator->sort('description') ?></th>
		<th><?= $this->Paginator->sort('phone') ?></th>
		<th><?= $this->Paginator->sort('email') ?></th>
		<th><?= $this->Paginator->sort('website') ?></th>
		<th><?= $this->Paginator->sort('address') ?></th>
		<th><?= $this->Paginator->sort('city') ?></th>
		<th><?= $this->Paginator->sort('state') ?></th>
		<th><?= $this->Paginator->sort('zip_code') ?></th>
		<th><?= $this->Paginator->sort('lat') ?></th>
		<th><?= $this->Paginator->sort('lng') ?></th>
		<th><?= $this->Paginator->sort('address_formatted') ?></th>
		<th><?= $this->Paginator->sort('active') ?></th>
		<th><?= $this->Paginator->sort('created') ?></th>
		<th><?= $this->Paginator->sort('modified') ?></th>
		<th class="actions"><?= __('Actions') ?></th>
	</tr>
	<?php foreach ($shops as $shop): ?>
	<tr>
		<td><?= h($shop->id) ?>&nbsp;</td>
		<td><?= h($shop->name) ?>&nbsp;</td>
		<td><?= h($shop->slug) ?>&nbsp;</td>
		<td><?= h($shop->description) ?>&nbsp;</td>
		<td><?= h($shop->phone) ?>&nbsp;</td>
		<td><?= h($shop->email) ?>&nbsp;</td>
		<td><?= h($shop->website) ?>&nbsp;</td>
		<td><?= h($shop->address) ?>&nbsp;</td>
		<td><?= h($shop->city) ?>&nbsp;</td>
		<td><?= h($shop->state) ?>&nbsp;</td>
		<td><?= h($shop->zip_code) ?>&nbsp;</td>
		<td><?= h($shop->lat) ?>&nbsp;</td>
		<td><?= h($shop->lng) ?>&nbsp;</td>
		<td><?= h($shop->address_formatted) ?>&nbsp;</td>
		<td><?= h($shop->active) ?>&nbsp;</td>
		<td><?= h($shop->created) ?>&nbsp;</td>
		<td><?= h($shop->modified) ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $shop->id]) ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $shop->id]) ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id)]) ?>
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
		<li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?></li>
	</ul>
</div>
