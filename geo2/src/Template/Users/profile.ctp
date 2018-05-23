<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Profile - ' . $user->name, '/profile/‎'. $user->slug); ?>

<h2><?php echo h($user->name); ?></h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Phone</td>
		<td><?php echo h($user->phone); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo h($user->email); ?></td>
	</tr>
</table>

<br />
<br />

<h2>Events organized by <?php echo h($user->name); ?></h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Location</th>
		<th>Event Date</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach($events as $event): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($event->location->name, array('controller' => 'Locations', 'action' => 'view', 'slug' => $event->location->slug)); ?>
			<br />
			<?php echo h($event->location->address); ?> <?php echo h($event->location->city); ?>, <?php echo h($event->location->state); ?> <?php echo h($event->location->zip_code); ?>
		</td>
		<td><?php echo $this->Time->format($event->start_date); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('controller' => 'Events', 'action' => 'view', $event->id), array('class' => 'btn btn-default btn-xs')); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php //debug($events); ?>