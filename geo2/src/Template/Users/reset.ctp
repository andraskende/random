<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb('Reset Password', '/reset'); ?>

<h1>Reset Password</h1>

<br />

<div class="row">
	<div class="col-sm-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Reset Password</h3>
			</div>
			<div class="panel-body">
				Enter your email address, an email will be sent to reset your password.
				<br />
				<br />
				<?php echo $this->Form->create('User'); ?>
				<?php echo $this->Form->input('email', array('class' => 'form-control', 'autofocus'=>'autofocus')); ?>
				<br />
				<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-block')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<br />
<br />
