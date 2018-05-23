<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Sign in', '/users/login'); ?>


<h1>Sign in</h1>

<br />

<div class="btn-group">
	<a href="/users/login" class="btn btn-default active">Sign in</a>
	<a href="/users/register" class="btn btn-default">New Account</a>
</div>

<br />
<br />

<div class="row">
<div class="col-sm-3">

<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<?php echo $this->Form->input('email', array('class' => 'form-control', 'autofocus' => 'autofocus')); ?>
<br />
<?php echo $this->Form->input('password', array('class' => 'form-control')); ?>
<br />
<?php echo $this->Form->button('Sign in', array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
<br />
<br />
<br />

</div>
</div>