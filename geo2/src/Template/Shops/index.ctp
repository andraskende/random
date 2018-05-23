<?php $this->Html->addCrumb('Home', 'http://www.kende.com'); ?>
<?php $this->Html->addCrumb('Hockey Shops', 'http://www.kende.com/shops'); ?>

<h1>Ice Hockey Shops</h1>

<br />
<br />

<table class="table-striped table-bordered table-condensed table-hover">
	<?php foreach ($shops as $shop): ?>
	<tr>
		<td><?php echo $this->Html->link($shop->name, array('controller' => 'Shops', 'action' => 'view', $shop->slug)); ?></td>
		<td><?php echo $this->Html->link($shop->website, $shop->website, array('target' => '_blank')); ?></td>
	</tr>
	<?php endforeach; ?>
</table>