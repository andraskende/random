<h2>Events</h2>

<div class="table-responsive">

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('user_id'); ?></th>
		<th><?php echo $this->Paginator->sort('location_id'); ?></th>
		<th><?php echo $this->Paginator->sort('start_date'); ?></th>
		<th><?php echo $this->Paginator->sort('capacity'); ?></th>
		<th><?php echo $this->Paginator->sort('price'); ?></th>
		<th><?php echo $this->Paginator->sort('description'); ?></th>
		<th><?php echo $this->Paginator->sort('active'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th><?php echo $this->Paginator->sort('modified'); ?></th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event->id); ?></td>
		<td><?php echo $this->Html->link($event->user->name, array('controller' => 'Users', 'action' => 'view', $event->user->id)); ?></td>
		<td><?php echo $this->Html->link($event->location->name, array('controller' => 'Locations', 'action' => 'view', $event->location->id)); ?></td>
		<td><?php echo $this->Time->format($event->start_date); ?></td>
		<td><?php echo h($event->capacity); ?></td>
		<td><?php echo h($event->price); ?></td>
		<td><?php echo h($event->description); ?></td>
		<td><?php echo $this->Html->image('icon_' . $event->active . '.png'); ?></td>
		<td><?php echo h($event->created); ?></td>
		<td><?php echo h($event->modified); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('action' => 'view', $event->id), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $event->id), array('class' => 'btn btn-primary btn-xs')); ?>
			<?php echo $this->Html->link('Invite', array('action' => 'invite', $event->id), array('class' => 'btn btn-success btn-xs')); ?>
			<?php echo $this->Html->link('Website', array('action' => 'view', $event->id, 'prefix' => false), array('class' => 'btn btn-info btn-xs', 'target' => '_blank')); ?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $event->id), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $event->id)); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

</div>

<br />

<?php echo $this->element('pagination'); ?>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('New Event', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />