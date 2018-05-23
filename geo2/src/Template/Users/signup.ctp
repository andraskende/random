<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Sign Up', '/users/signup'); ?>

<h1>Sign Up</h1>

<br />

<div class="btn-group">
	<a href="/users/login" class="btn btn-default">Log In</a>
	<a href="/users/signup" class="btn btn-default active">Sign Up</a>
</div>

<br />
<br />

<div class="row">
	<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Sign Up</h3>
			</div>
			<div class="panel-body">
				<?php echo $this->Form->create($user); ?>
				<?php echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('player' => 'player', 'organizer' => 'organizer'))); ?>
				<br />
				<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
				<br />
				<?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
				<br />
				<?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
				<br />
				<?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
				<br />
				<?php echo $this->Form->input('active', array('type'=>'checkbox', 'label'=> 'By Registering, I accept kende.com Terms of Use.', 'required' => true)); ?>
				<br />
				<?php echo $this->Form->button('Sign Up', array('class' => 'btn btn-primary btn-block')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<br />
