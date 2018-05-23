<h2>Admin Edit Contact</h2>

<div class="row">
	<div class="col-sm-5">

		<?php echo $this->Form->create('Comment'); ?>

		<?php echo $this->Form->input('id'); ?>
		<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('message', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('memo', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>

		<br />
		<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Form->end(); ?>

	</div>
</div>