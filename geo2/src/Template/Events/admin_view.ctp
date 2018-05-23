<div class="events view">
<h2>Event</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Id</td>
		<td><?php echo h($event['Event']['id']); ?></td>
	</tr>
	<tr>
		<td>User</td>
		<td><?php echo $this->Html->link($event['User']['name'], array('controller' => 'users', 'action' => 'view', $event['User']['id'])); ?></td>
	</tr>
	<tr>
		<td>Location</td>
		<td><?php echo $this->Html->link($event['Location']['name'], array('controller' => 'locations', 'action' => 'view', $event['Location']['id'])); ?></td>
	</tr>
	<tr>
		<td>Start Date</td>
		<td>
			<?php echo h($event['Event']['start_date']); ?>
			<br />
			<?php echo $this->Time->format('l, F jS, Y h:i A', $event['Event']['start_date']); ?>
		</td>
	</tr>
	<tr>
		<td>Capacity</td>
		<td><?php echo h($event['Event']['capacity']); ?></td>
	</tr>
	<tr>
		<td>Price</td>
		<td><?php echo h($event['Event']['price']); ?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><?php echo h($event['Event']['description']); ?></td>
	</tr>
	<tr>
		<td>Active</td>
		<td><?php echo h($event['Event']['active']); ?></td>
	</tr>
	<tr>
		<td>Created</td>
		<td><?php echo h($event['Event']['created']); ?></td>
	</tr>
	<tr>
		<td>Modified</td>
		<td><?php echo h($event['Event']['modified']); ?></td>
	</tr>
</table>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('Edit Event', array('action' => 'edit', $event['Event']['id']), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Html->link('Website', array('action' => 'view', $event['Event']['id'], 'admin' => false), array('class' => 'btn btn-default', 'target' => '_blank')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete Event', array('action' => 'delete', $event['Event']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>

<br />
<br />
<br />

<h3>Related Registrations</h3>

<?php if (!empty($event['Registration'])): ?>
	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Id</th>
		<th>User Id</th>
		<th>Event Id</th>
		<th>Price</th>
		<th>Memo</th>
		<th>Active</th>
		<th>Created</th>
		<th>Modified</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($event['Registration'] as $registration): ?>
		<tr>
			<td><?php echo $registration['id']; ?></td>
			<td><?php echo $registration['user_id']; ?></td>
			<td><?php echo $registration['event_id']; ?></td>
			<td><?php echo $registration['price']; ?></td>
			<td><?php echo $registration['memo']; ?></td>
			<td><?php echo $registration['active']; ?></td>
			<td><?php echo $registration['created']; ?></td>
			<td><?php echo $registration['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'registrations', 'action' => 'view', $registration['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'registrations', 'action' => 'edit', $registration['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'registrations', 'action' => 'delete', $registration['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $registration['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

