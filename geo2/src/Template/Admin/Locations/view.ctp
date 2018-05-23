<div class="locations view">
	<h2><?= __('Location') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($location->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Placeid') ?></dt>
		<dd>
			<?= h($location->placeid) ?>
			&nbsp;
		</dd>
		<dt><?= __('Name') ?></dt>
		<dd>
			<?= h($location->name) ?>
			&nbsp;
		</dd>
		<dt><?= __('Slug') ?></dt>
		<dd>
			<?= h($location->slug) ?>
			&nbsp;
		</dd>
		<dt><?= __('Description') ?></dt>
		<dd>
			<?= h($location->description) ?>
			&nbsp;
		</dd>
		<dt><?= __('Formatted Address') ?></dt>
		<dd>
			<?= h($location->formatted_address) ?>
			&nbsp;
		</dd>
		<dt><?= __('Reference') ?></dt>
		<dd>
			<?= h($location->reference) ?>
			&nbsp;
		</dd>
		<dt><?= __('Vicinity') ?></dt>
		<dd>
			<?= h($location->vicinity) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($location->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Response') ?></dt>
		<dd>
			<?= h($location->response) ?>
			&nbsp;
		</dd>
		<dt><?= __('Phone') ?></dt>
		<dd>
			<?= h($location->phone) ?>
			&nbsp;
		</dd>
		<dt><?= __('Address') ?></dt>
		<dd>
			<?= h($location->address) ?>
			&nbsp;
		</dd>
		<dt><?= __('City') ?></dt>
		<dd>
			<?= h($location->city) ?>
			&nbsp;
		</dd>
		<dt><?= __('State') ?></dt>
		<dd>
			<?= h($location->state) ?>
			&nbsp;
		</dd>
		<dt><?= __('Postal Code') ?></dt>
		<dd>
			<?= h($location->postal_code) ?>
			&nbsp;
		</dd>
		<dt><?= __('Lat') ?></dt>
		<dd>
			<?= h($location->lat) ?>
			&nbsp;
		</dd>
		<dt><?= __('Lng') ?></dt>
		<dd>
			<?= h($location->lng) ?>
			&nbsp;
		</dd>
		<dt><?= __('Views') ?></dt>
		<dd>
			<?= h($location->views) ?>
			&nbsp;
		</dd>
		<dt><?= __('Email') ?></dt>
		<dd>
			<?= h($location->email) ?>
			&nbsp;
		</dd>
		<dt><?= __('Website') ?></dt>
		<dd>
			<?= h($location->website) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($location->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($location->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->id], ['confirm' => __('Are you sure you want to delete # %s?', $location->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?> </li>
	</ul>
</div>
