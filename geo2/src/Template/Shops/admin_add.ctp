<h2>Add Shop</h2>

<div class="row">
	<div class="col-sm-5">

		<?php echo $this->Form->create('Shop'); ?>
		<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('website', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('address', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('city', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('state', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('zip_code', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('lat', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('lng', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
		<br />
		<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Form->end(); ?>

	</div>
</div>