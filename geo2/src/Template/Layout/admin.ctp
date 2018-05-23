<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title_for_layout; ?></title>
<?php echo $this->Html->css(array('bootstrap.min.css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css', 'admin.css')); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<?php echo $this->Html->script(array('bootstrap.min.js', 'admin.js')); ?>

<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>
</head>
<body>

	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"> ADMIN</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Locations', array('controller' => 'locations', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Reviews', array('controller' => 'reviews', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Events', array('controller' => 'events', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Registrations', array('controller' => 'registrations', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Contacts', array('controller' => 'contacts', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Shops', array('controller' => 'shops', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Comments', array('controller' => 'comments', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'prefix' => false)); ?></li>
			</ul>
		</div>
	</div>

	<div class="content">

		<?= $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
		<?php // echo $this->element('sql_dump'); ?>

		<br />
		<br />

		<div class="footetr">
			<p>&copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></p>
		</div>

	</div>

</body>
</html>

