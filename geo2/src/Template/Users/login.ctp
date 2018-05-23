<?php $this->Html->addCrumb('Home', 'http://www.kende.com'); ?>
<?php $this->Html->addCrumb('Log In', '/users/login/'); ?>

<h1>Log In</h1>

<br />

<div class="btn-group">
	<a href="/users/login" class="btn btn-default active">Log In</a>
	<a href="/users/signup" class="btn btn-default">Sign Up</a>
</div>

<br />
<br />

<div class="row">
	<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Log In</h3>
			</div>
			<div class="panel-body">
				<?php echo $this->Form->create('User', array('action' => 'login')); ?>
				<?php echo $this->Form->input('email', array('class' => 'form-control', 'autofocus' => 'autofocus')); ?>
				<br />
				<?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
				<a href="/users/reset">Forgot your Password?</a>
				<br />
				<br />
				<?php echo $this->Form->button('Log in', array('class' => 'btn btn-primary btn-block')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<br />
