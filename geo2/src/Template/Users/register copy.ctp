<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Register', '/users/register'); ?>

<h1>Create account</h1>

<br />

<div class="btn-group">
	<a href="/users/login" class="btn btn-default">Sign in</a>
	<a href="/users/register" class="btn btn-default active">New Account</a>
</div>

<br />
<br />

<div class="row">
<div class="col-sm-3">

<?php echo $this->Form->create('User', array('action' => 'register')); ?>
<?php echo $this->Form->input('email', array('class' => 'form-control', 'autofocus' => 'autofocus')); ?>
<br />
<?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
<br />
<?php echo $this->Form->button('Register', array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
<br />

</div>
</div>

<br />
<br />