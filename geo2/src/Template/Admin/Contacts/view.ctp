<div class="contacts view">
	<h2><?= __('Contact') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($contact->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('User Id') ?></dt>
		<dd>
			<?= h($contact->user_id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Name') ?></dt>
		<dd>
			<?= h($contact->name) ?>
			&nbsp;
		</dd>
		<dt><?= __('Phone') ?></dt>
		<dd>
			<?= h($contact->phone) ?>
			&nbsp;
		</dd>
		<dt><?= __('Email') ?></dt>
		<dd>
			<?= h($contact->email) ?>
			&nbsp;
		</dd>
		<dt><?= __('Notes') ?></dt>
		<dd>
			<?= h($contact->notes) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($contact->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($contact->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($contact->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Contact'), ['action' => 'edit', $contact->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contact'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # %s?', $contact->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?> </li>
	</ul>
</div>
