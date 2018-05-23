
<h2>Shop</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Id</td>
		<td><?php echo h($shop['Shop']['id']); ?></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><?php echo h($shop['Shop']['name']); ?></td>
	</tr>
	<tr>
		<td>Slug</td>
		<td><?php echo h($shop['Shop']['slug']); ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo h($shop['Shop']['phone']); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo h($shop['Shop']['email']); ?></td>
	</tr>
	<tr>
		<td>Website</td>
		<td><?php echo h($shop['Shop']['website']); ?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?php echo h($shop['Shop']['address']); ?></td>
	</tr>
	<tr>
		<td>City</td>
		<td><?php echo h($shop['Shop']['city']); ?></td>
	</tr>
	<tr>
		<td>State</td>
		<td><?php echo h($shop['Shop']['state']); ?></td>
	</tr>
	<tr>
		<td>zip_code</td>
		<td><?php echo h($shop['Shop']['zip_code']); ?></td>
	</tr>
	<tr>
		<td>Lat</td>
		<td><?php echo h($shop['Shop']['lat']); ?></td>
	</tr>
	<tr>
		<td>Lng</td>
		<td><?php echo h($shop['Shop']['lng']); ?></td>
	</tr>
	<tr>
		<td>Active</td>
		<td><?php echo h($shop['Shop']['active']); ?></td>
	</tr>
	<tr>
		<td>Created</td>
		<td><?php echo h($shop['Shop']['created']); ?></td>
	</tr>
	<tr>
		<td>Modified</td>
		<td><?php echo h($shop['Shop']['modified']); ?></td>
	</tr>
</table>

<br />
<br />


<h3>Actions</h3>

<?php echo $this->Html->link('Edit Shop', array('action' => 'edit', $shop['Shop']['id']), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete Shop', array('action' => 'delete', $shop['Shop']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $shop['Shop']['id'])); ?>

<br />
<br />
