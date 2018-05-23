<script>

$(document).ready(function() {

	$('.name').editable({
		type: 'text',
		name: 'name',
		url: '<?php echo $this->webroot; ?>admin/shops/editable',
		title: 'name',
		placement: 'right',
	});

	$('.slug').editable({
		type: 'text',
		name: 'slug',
		url: '<?php echo $this->webroot; ?>admin/shops/editable',
		title: 'slug',
		placement: 'right',
	});

	$('.email').editable({
		type: 'text',
		name: 'email',
		url: '<?php echo $this->webroot; ?>admin/shops/editable',
		title: 'email',
		placement: 'right',
	});

});

</script>

<h2>Shops</h2>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('slug'); ?></th>
		<th><?php echo $this->Paginator->sort('phone'); ?></th>
		<th><?php echo $this->Paginator->sort('email'); ?></th>
		<th><?php echo $this->Paginator->sort('website'); ?></th>
		<th><?php echo $this->Paginator->sort('address'); ?></th>
		<th><?php echo $this->Paginator->sort('city'); ?></th>
		<th><?php echo $this->Paginator->sort('state'); ?></th>
		<th><?php echo $this->Paginator->sort('zip_code'); ?></th>
		<th><?php echo $this->Paginator->sort('lat'); ?></th>
		<th><?php echo $this->Paginator->sort('lng'); ?></th>
		<th><?php echo $this->Paginator->sort('active'); ?></th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th><?php echo $this->Paginator->sort('modified'); ?></th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($shops as $shop): ?>
	<tr>
		<td><?php echo h($shop['Shop']['id']); ?></td>
		<td><span class="name" data-value="<?php echo $shop['Shop']['name']; ?>" data-pk="<?php echo $shop['Shop']['id']; ?>"><?php echo $shop['Shop']['name']; ?></span></td>
		<td><span class="slug" data-value="<?php echo $shop['Shop']['slug']; ?>" data-pk="<?php echo $shop['Shop']['id']; ?>"><?php echo $shop['Shop']['slug']; ?></span></td>
		<td><?php echo h($shop['Shop']['phone']); ?></td>
		<td><span class="email" data-value="<?php echo $shop['Shop']['email']; ?>" data-pk="<?php echo $shop['Shop']['id']; ?>"><?php echo $shop['Shop']['email']; ?></span></td>
		<td><?php echo h($shop['Shop']['website']); ?></td>
		<td><?php echo h($shop['Shop']['address']); ?></td>
		<td><?php echo h($shop['Shop']['city']); ?></td>
		<td><?php echo h($shop['Shop']['state']); ?></td>
		<td><?php echo h($shop['Shop']['zip_code']); ?></td>
		<td><?php echo h($shop['Shop']['lat']); ?></td>
		<td><?php echo h($shop['Shop']['lng']); ?></td>
		<td><?php echo $this->Html->link($this->Html->image('icon_' . $shop['Shop']['active'] . '.png'), array('controller' => 'shops', 'action' => 'switch', 'active', $shop['Shop']['id']), array('class' => 'switch', 'escape' => false)); ?></td>
		<td><?php echo h($shop['Shop']['created']); ?></td>
		<td><?php echo h($shop['Shop']['modified']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('View', array('action' => 'view', $shop['Shop']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $shop['Shop']['id']), array('class' => 'btn btn-default btn-xs')); ?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $shop['Shop']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $shop['Shop']['id'])); ?>
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

<?php echo $this->Html->link('New Shop', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />
