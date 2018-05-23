<h2>Contact</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Id</td>
		<td><?php echo h($comment['Comment']['id']); ?></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><?php echo h($comment['Comment']['name']); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo h($comment['Comment']['email']); ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo h($comment['Comment']['phone']); ?></td>
	</tr>
	<tr>
		<td>Message</td>
		<td><?php echo h($comment['Comment']['message']); ?></td>
	</tr>
	<tr>
		<td>Memo</td>
		<td><?php echo h($comment['Comment']['memo']); ?></td>
	</tr>
	<tr>
		<td>Active</td>
		<td><?php echo h($comment['Comment']['active']); ?></td>
	</tr>
	<tr>
		<td>Created</td>
		<td><?php echo h($comment['Comment']['created']); ?></td>
	</tr>
</table>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('Edit Contact', array('action' => 'edit', $comment['Comment']['id']), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete Contact', array('action' => 'delete', $comment['Comment']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>

<br />
<br />