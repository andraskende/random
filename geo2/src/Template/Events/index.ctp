<?php $this->Html->addCrumb('Home', '/'); ?>
<?php $this->Html->addCrumb('Events', '/events'); ?>

<h1>Events</h1>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Location</th>
		<th>Date</th>
		<th>Organizer</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>.
		<td>

		<?php //debug($event->toArray()); ?>

		<?php echo $this->Html->link($event->location->name, array('controller' => 'Locations', 'action' => 'view', 'slug' => $event->location->slug)); ?></td>
		<td><?php echo $this->Time->format($event->start_date); ?></td>
		<td><?php echo $this->Html->link($event->user->name, array('controller' => 'Users', 'action' => 'profile', 'slug' => $event->user->slug)); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('controller' => 'events', 'action' => 'view', $event->id), array('class' => 'btn btn-default btn-sm')); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<br />
<br />
