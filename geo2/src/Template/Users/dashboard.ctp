<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Dashboard‎', '/users/dashboard/'); ?>

<h2>My Profile</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Name</td>
		<td><?php echo h($user->name); ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo h($user->phone); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo h($user->email); ?></td>
	</tr>
</table>

<h2>My Registrations</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Location</th>
		<th>Event Date</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach($registrations as $registration): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($registration->location->name, array('controller' => 'locations', 'action' => 'view', 'slug' => $registration->location->slug)); ?>
			<br />
			<?php echo h($registration->location->address); ?> <?php echo h($registration->location->city); ?>, <?php echo h($registration->location->state); ?> <?php echo h($registration->zip_code); ?>
		</td>
		<td><?php echo $this->Time->format($registration->event->start_date); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('controller' => 'Events', 'action' => 'view', $registration->event->id), array('class' => 'btn btn-default btn-xs')); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php //debug($registrations); ?>