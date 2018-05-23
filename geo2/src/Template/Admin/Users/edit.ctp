<h2>Edit User</h2>

<div class="row">
	<div class="col-sm-5">
		<?= $this->Form->create($user) ?>
		<?php echo $this->Form->input('role', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
		<br />
		<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<br />
<br />
