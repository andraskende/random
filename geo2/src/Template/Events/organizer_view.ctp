<script>

$(document).ready(function() {

	$('.memo').editable({
		type: 'text',
		name: 'memo',
		url: '<?php echo $this->webroot; ?>organizer/registrations/editable',
		title: 'memo',
		placement: 'right',
	});

	$('.status').editable({
		type: 'select',
		name: 'status',
		url: '<?php echo $this->webroot; ?>organizer/registrations/editable',
		title: 'status',
		source: {
			"Pending" : "Pending",
			"Confirmed" : "Confirmed",
			"Canceled" : "Canceled",
		},
		placement: 'right',
	});

});

</script>



<h2>Event</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Id</td>
		<td><?php echo h($event['Event']['id']); ?></td>
	</tr>
	<tr>
		<td>URL</td>
		<td><?php echo $this->Html->url(array('action' => 'view', $event['Event']['id'], 'organizer' => false, 'full_base' => true)); ?></td>
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
		<td><?php echo $this->Time->format('l, F jS, Y h:i A', $event['Event']['start_date']); ?></td>
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

<span class="hidden-print">

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('Edit Event', array('action' => 'edit', $event['Event']['id']), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Html->link('Website', array('action' => 'view', $event['Event']['id'], 'organizer' => false), array('class' => 'btn btn-default', 'target' => '_blank')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete Event', array('action' => 'delete', $event['Event']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>

<br />
<br />

</span>

<?php if (!empty($registrations)): ?>
	<h3>Active Registrations</h3>
	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>User Name</th>
		<th>User Phone</th>
		<th>User Email</th>
		<th>Play as</th>
		<th>Price</th>
		<th>Memo</th>
		<th>Status</th>
		<th>Active</th>
		<th>Created</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($registrations as $registration): ?>
		<tr>
			<td><?php echo $registration['User']['name']; ?></td>
			<td><?php echo $registration['User']['phone']; ?></td>
			<td><?php echo $registration['User']['email']; ?></td>
			<td><?php echo $registration['Registration']['play_as']; ?></td>
			<td><?php echo $registration['Registration']['price']; ?></td>
			<td><span class="memo" data-value="<?php echo $registration['Registration']['memo']; ?>" data-pk="<?php echo $registration['Registration']['id']; ?>"><?php echo $registration['Registration']['memo']; ?></span></td>
			<td><span class="status" data-value="<?php echo $registration['Registration']['status']; ?>" data-pk="<?php echo $registration['Registration']['id']; ?>"><?php echo $registration['Registration']['status']; ?></span></td>
			<td>
				<span class="hidden-print">
				<?php echo $this->Html->link($this->Html->image('icon_' . $registration['Registration']['active'] . '.png'), array('controller' => 'registrations', 'action' => 'switch', 'active', $registration['Registration']['id']), array('class' => 'switch', 'escape' => false)); ?>
				</span>
			</td>
			<td><?php echo $registration['Registration']['created']; ?></td>
			<td class="actions">
				<span class="hidden-print">
				<?php echo $this->Html->link('View', array('controller' => 'registrations', 'action' => 'view', $registration['Registration']['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'registrations', 'action' => 'edit', $registration['Registration']['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink('Delete', array('controller' => 'registrations', 'action' => 'delete', $registration['Registration']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $registration['Registration']['id'])); ?>
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


<?php if (!empty($deletedregistrations)): ?>
	<h3>Canceled Registrations</h3>
	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>User Name</th>
		<th>User Phone</th>
		<th>User Email</th>
		<th>Play as</th>
		<th>Price</th>
		<th>Memo</th>
		<th>Status</th>
		<th>Active</th>
		<th>Created</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($deletedregistrations as $deletedregistration): ?>
		<tr>
			<td><?php echo $deletedregistration['User']['name']; ?></td>
			<td><?php echo $deletedregistration['User']['phone']; ?></td>
			<td><?php echo $deletedregistration['User']['email']; ?></td>
			<td><?php echo $deletedregistration['Registration']['play_as']; ?></td>
			<td><?php echo $deletedregistration['Registration']['price']; ?></td>
			<td><span class="memo" data-value="<?php echo $deletedregistration['Registration']['memo']; ?>" data-pk="<?php echo $deletedregistration['Registration']['id']; ?>"><?php echo $deletedregistration['Registration']['memo']; ?></span></td>
			<td><span class="status" data-value="<?php echo $deletedregistration['Registration']['status']; ?>" data-pk="<?php echo $deletedregistration['Registration']['id']; ?>"><?php echo $deletedregistration['Registration']['status']; ?></span></td>
			<td>
				<span class="hidden-print">
				<?php echo $this->Html->link($this->Html->image('icon_' . $deletedregistration['Registration']['active'] . '.png'), array('controller' => 'registrations', 'action' => 'switch', 'active', $deletedregistration['Registration']['id']), array('class' => 'switch', 'escape' => false)); ?>
				</span>
			</td>
			<td><?php echo $deletedregistration['Registration']['created']; ?></td>
			<td class="actions">
				<span class="hidden-print">
				<?php echo $this->Html->link('View', array('controller' => 'registrations', 'action' => 'view', $deletedregistration['Registration']['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'registrations', 'action' => 'edit', $deletedregistration['Registration']['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink('Delete', array('controller' => 'registrations', 'action' => 'delete', $deletedregistration['Registration']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $deletedregistration['Registration']['id'])); ?>
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


