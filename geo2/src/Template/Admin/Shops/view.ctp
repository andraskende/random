<div class="shops view">
	<h2><?= __('Shop') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($shop->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Name') ?></dt>
		<dd>
			<?= h($shop->name) ?>
			&nbsp;
		</dd>
		<dt><?= __('Slug') ?></dt>
		<dd>
			<?= h($shop->slug) ?>
			&nbsp;
		</dd>
		<dt><?= __('Description') ?></dt>
		<dd>
			<?= h($shop->description) ?>
			&nbsp;
		</dd>
		<dt><?= __('Phone') ?></dt>
		<dd>
			<?= h($shop->phone) ?>
			&nbsp;
		</dd>
		<dt><?= __('Email') ?></dt>
		<dd>
			<?= h($shop->email) ?>
			&nbsp;
		</dd>
		<dt><?= __('Website') ?></dt>
		<dd>
			<?= h($shop->website) ?>
			&nbsp;
		</dd>
		<dt><?= __('Address') ?></dt>
		<dd>
			<?= h($shop->address) ?>
			&nbsp;
		</dd>
		<dt><?= __('City') ?></dt>
		<dd>
			<?= h($shop->city) ?>
			&nbsp;
		</dd>
		<dt><?= __('State') ?></dt>
		<dd>
			<?= h($shop->state) ?>
			&nbsp;
		</dd>
		<dt><?= __('Zip Code') ?></dt>
		<dd>
			<?= h($shop->zip_code) ?>
			&nbsp;
		</dd>
		<dt><?= __('Lat') ?></dt>
		<dd>
			<?= h($shop->lat) ?>
			&nbsp;
		</dd>
		<dt><?= __('Lng') ?></dt>
		<dd>
			<?= h($shop->lng) ?>
			&nbsp;
		</dd>
		<dt><?= __('Address Formatted') ?></dt>
		<dd>
			<?= h($shop->address_formatted) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($shop->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($shop->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($shop->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Shop'), ['action' => 'edit', $shop->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Shop'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # %s?', $shop->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?> </li>
	</ul>
</div>
