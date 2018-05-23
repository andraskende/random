<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>kende.com</title>
<?php echo $this->Html->css(array('bootstrap.min.css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css', 'admin.css')); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<?php echo $this->Html->script(array('bootstrap.min.js', 'admin.js')); ?>

<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">kende.com</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/" target="_blank">Home</a></li>
					<li><?php echo $this->Html->link('Events', array('controller' => 'Events', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Registrations', array('controller' => 'Registrations', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Contacts', array('controller' => 'Contacts', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link('Logout', array('controller' => 'Users', 'action' => 'logout', 'prefix' => false)); ?></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $authuser['name']; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Logout', array('controller' => 'Users', 'action' => 'logout', 'prefix' => false), array('escape' => false)); ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

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

