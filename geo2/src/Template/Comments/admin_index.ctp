<script>
$(document).ready(function() {

	$('.memo').editable({
		type: 'textarea',
		name: 'memo',
		url: '<?php echo $this->webroot; ?>admin/comments/editable',
		title: 'Memo',
		placement: 'left',
	});

});
</script>

<h2>Comments</h2>

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />

<table class="table table-striped table-bordered table-condensed table-hover">
	<tr>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('email'); ?></th>
		<th><?php echo $this->Paginator->sort('phone'); ?></th>
		<th><?php echo $this->Paginator->sort('message'); ?></th>
		<th><?php echo $this->Paginator->sort('memo'); ?></th>
		<th><?php echo $this->Paginator->sort('active'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($comments as $comment): ?>
	<tr>
		<td><?php echo h($comment['Comment']['name']); ?></td>
		<td><?php echo h($comment['Comment']['email']); ?></td>
		<td><?php echo h($comment['Comment']['phone']); ?></td>
		<td><?php echo h($comment['Comment']['message']); ?></td>
		<td><span class="memo" data-value="<?php echo $comment['Comment']['memo']; ?>" data-pk="<?php echo $comment['Comment']['id']; ?>"><?php echo $comment['Comment']['memo']; ?></span></td>
		<td><?php echo h($comment['Comment']['active']); ?></td>
		<td><?php echo h($comment['Comment']['created']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('action' => 'view', $comment['Comment']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $comment['Comment']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comment['Comment']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
