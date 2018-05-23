<h2>Events</h2>

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
		<td><?php echo h($event['Event']['id']); ?></td>
		<td><?php echo $this->Html->link($event['User']['name'], array('controller' => 'users', 'action' => 'view', $event['User']['id'])); ?></td>
		<td><?php echo $this->Html->link($event['Location']['name'], array('controller' => 'locations', 'action' => 'view', $event['Location']['id'])); ?></td>
		<td><?php echo h($event['Event']['start_date']); ?></td>
		<td><?php echo h($event['Event']['capacity']); ?></td>
		<td><?php echo h($event['Event']['price']); ?></td>
		<td><?php echo h($event['Event']['description']); ?></td>
		<td><?php echo $this->Html->link($this->Html->image('icon_' . $event['Event']['active'] . '.png'), array('controller' => 'events', 'action' => 'switch', 'active', $event['Event']['id']), array('class' => 'switch', 'escape' => false)); ?></td>
		<td><?php echo h($event['Event']['created']); ?></td>
		<td><?php echo h($event['Event']['modified']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('action' => 'view', $event['Event']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $event['Event']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link('Website', array('action' => 'view', $event['Event']['id'], 'admin' => false), array('class' => 'btn btn-default btn-xs', 'target' => '_blank')); ?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $event['Event']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('New Event', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />