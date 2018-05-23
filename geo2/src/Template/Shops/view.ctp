<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Hockey Shops', 'http://www.kende.com/shops'); ?>
<?php $this->Html->addCrumb($shop->name, '/shop/' . $shop->slug); ?>

<h1><?php echo h($shop->name); ?></h1>

<span class="glyphicon glyphicon-hand-right"></span> <strong><?php echo $this->Html->link($shop->website, $shop->website, array('target' => '_blank')); ?></stgrong>