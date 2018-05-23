<script>

$(document).ready(function() {

	$('.memo').editable({
		type: 'text',
		name: 'memo',
		url: '/organizer/registrations/editable',
		title: 'memo',
		placement: 'right',
	});

	$('.status').editable({
		type: 'select',
		name: 'status',
		url: '/organizer/registrations/editable',
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
		<td><?php echo h($event->id); ?></td>
	</tr>
	<tr>
		<td>URL</td>
		<td><?php echo $this->Html->link(array('action' => 'view', $event->id, 'prefix' => false)); ?></td>
	</tr>
	<tr>
		<td>User</td>
		<td><?php echo $this->Html->link($event->user->name, array('controller' => 'users', 'action' => 'view', $event->user->id)); ?></td>
	</tr>
	<tr>
		<td>Location</td>
		<td><?php echo $this->Html->link($event->location->name, array('controller' => 'locations', 'action' => 'view', $event->location->id)); ?></td>
	</tr>
	<tr>
		<td>Start Date</td>
		<td><?php echo $this->Time->format($event->start_date); ?></td>
	</tr>
	<tr>
		<td>Capacity</td>
		<td><?php echo h($event->capacity); ?></td>
	</tr>
	<tr>
		<td>Price</td>
		<td><?php echo h($event->price); ?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><?php echo h($event->description); ?></td>
	</tr>
	<tr>
		<td>Active</td>
		<td><?php echo h($event->active); ?></td>
	</tr>
	<tr>
		<td>Created</td>
		<td><?php echo h($event->created); ?></td>
	</tr>
	<tr>
		<td>Modified</td>
		<td><?php echo h($event->modified); ?></td>
	</tr>
</table>

<span class="hidden-print">

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('Edit Event', array('action' => 'edit', $event->id), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Html->link('Website', array('action' => 'view', $event->id, 'prefix' => false), array('class' => 'btn btn-default', 'target' => '_blank')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete Event', array('action' => 'delete', $event->id), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $event->id)); ?>

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
			<td><?php echo $registration->user->name; ?></td>
			<td><?php echo $registration->user->phone; ?></td>
			<td><?php echo $registration->user->email; ?></td>
			<td><?php echo $registration->play_as; ?></td>
			<td><?php echo $registration->price; ?></td>
			<td><span class="memo" data-value="<?php echo $registration->memo; ?>" data-pk="<?php echo $registration->id; ?>"><?php echo $registration->memo; ?></span></td>
			<td><span class="status" data-value="<?php echo $registration->status; ?>" data-pk="<?php echo $registration->id; ?>"><?php echo $registration->status; ?></span></td>
			<td>
				<span class="hidden-print">
				<?php echo $this->Html->link($this->Html->image('icon_' . $registration->active . '.png'), array('controller' => 'Registrations', 'action' => 'switch', 'active', $registration->id), array('class' => 'switch', 'escape' => false)); ?>
				</span>
			</td>
			<td><?php echo $registration->created; ?></td>
			<td class="actions">
				<span class="hidden-print">
				<?php echo $this->Html->link('View', array('controller' => 'registrations', 'action' => 'view', $registration->id), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'registrations', 'action' => 'edit', $registration->id), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink('Delete', array('controller' => 'registrations', 'action' => 'delete', $registration->id), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $registration->id)); ?>
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
			<td><?php echo $deletedregistration->user->name; ?></td>
			<td><?php echo $deletedregistration->user->phone; ?></td>
			<td><?php echo $deletedregistration->user->email; ?></td>
			<td><?php echo $deletedregistration->play_as; ?></td>
			<td><?php echo $deletedregistration->price; ?></td>
			<td><span class="memo" data-value="<?php echo $deletedregistration->memo; ?>" data-pk="<?php echo $deletedregistration->id; ?>"><?php echo $deletedregistration->memo; ?></span></td>
			<td><span class="status" data-value="<?php echo $deletedregistration->status; ?>" data-pk="<?php echo $deletedregistration->id; ?>"><?php echo $deletedregistration->status; ?></span></td>
			<td>
				<span class="hidden-print">
				<?php echo $this->Html->link($this->Html->image('icon_' . $deletedregistration->active . '.png'), array('controller' => 'Registrations', 'action' => 'switch', 'active', $deletedregistration->id), array('class' => 'switch', 'escape' => false)); ?>
				</span>
			</td>
			<td><?php echo $deletedregistration->created; ?></td>
			<td class="actions">
				<span class="hidden-print">
				<?php echo $this->Html->link('View', array('controller' => 'Registrations', 'action' => 'view', $deletedregistration->id), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'Registrations', 'action' => 'edit', $deletedregistration->id), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink('Delete', array('controller' => 'Registrations', 'action' => 'delete', $deletedregistration->id), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $deletedregistration->id)); ?>
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


