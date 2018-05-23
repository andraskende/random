<h2>User</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Id</td>
		<td><?php echo h($user->id); ?></td>
	</tr>
	<tr>
		<td>Role</td>
		<td><?php echo h($user->role); ?></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><?php echo h($user->name); ?></td>
	</tr>
	<tr>
		<td>Slug</td>
		<td><?php echo h($user->slug); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo h($user->email); ?></td>
	</tr>
	<tr>
		<td>Password Clear</td>
		<td><?php echo h($user->password_clear); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo h($user->password); ?></td>
	</tr>
	<tr>
		<td>Created</td>
		<td><?php echo h($user->created); ?></td>
	</tr>
	<tr>
		<td>Modified</td>
		<td><?php echo h($user->modified); ?></td>
	</tr>
</table>

<br />
<br />

<h3>Actions</h3>

<br />

<?php echo $this->Html->link('Edit User', array('action' => 'edit', $user->id), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete User', ['action' => 'delete', $user->id], array('class' => 'btn btn-danger'), ['confirm' => __('Are you sure you want to delete # %s?', $user->id)]); ?>

<br />
<br />


<h3><?= __('Related Events') ?></h3>
<?php if (!empty($user->events)): ?>
	<table class="table-striped table-bordered table-condensed table-hover">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Location Id') ?></th>
			<th><?= __('Start Date') ?></th>
			<th><?= __('End Date') ?></th>
			<th><?= __('Timezone') ?></th>
			<th><?= __('Privacy') ?></th>
			<th><?= __('Capacity') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Description') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->events as $events): ?>
		<tr>
			<td><?= h($events->id) ?></td>
			<td><?= h($events->user_id) ?></td>
			<td><?= h($events->location_id) ?></td>
			<td><?= h($events->start_date) ?></td>
			<td><?= h($events->end_date) ?></td>
			<td><?= h($events->timezone) ?></td>
			<td><?= h($events->privacy) ?></td>
			<td><?= h($events->capacity) ?></td>
			<td><?= h($events->price) ?></td>
			<td><?= h($events->description) ?></td>
			<td><?= h($events->active) ?></td>
			<td><?= h($events->created) ?></td>
			<td><?= h($events->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # %s?', $events->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>


<h3><?= __('Related Registrations') ?></h3>
<?php if (!empty($user->registrations)): ?>
	<table class="table-striped table-bordered table-condensed table-hover">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Location Id') ?></th>
			<th><?= __('Play As') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Memo') ?></th>
			<th><?= __('Status') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->registrations as $registrations): ?>
		<tr>
			<td><?= h($registrations->id) ?></td>
			<td><?= h($registrations->user_id) ?></td>
			<td><?= h($registrations->event_id) ?></td>
			<td><?= h($registrations->location_id) ?></td>
			<td><?= h($registrations->play_as) ?></td>
			<td><?= h($registrations->price) ?></td>
			<td><?= h($registrations->memo) ?></td>
			<td><?= h($registrations->status) ?></td>
			<td><?= h($registrations->active) ?></td>
			<td><?= h($registrations->created) ?></td>
			<td><?= h($registrations->modified) ?></td>
			<td class="actions">
				<?php //$this->Html->link(__('View'), ['controller' => 'Registrations', 'action' => 'view', $registrations->id]); ?>
				<?php //$this->Html->link(__('Edit'), ['controller' => 'Registrations', 'action' => 'edit', $registrations->id]); ?>
				<?php //$this->Form->postLink(__('Delete'), ['controller' => 'Registrations', 'action' => 'delete', $registrations->id], ['confirm' => __('Are you sure you want to delete # %s?', $registrations->id)]); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>
