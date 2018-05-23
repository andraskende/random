<link rel="stylesheet" href="/select2/select2.css" type="text/css">
<link rel="stylesheet" href="/select2/select2-bootstrap.css">
<script src="/select2/select2.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	$("#EventUserId").select2();

	$("#EventLocationId").select2();

});

</script>

<h2>Add Event</h2>

<div class="row">
	<div class="col-sm-5">

		<?php echo $this->Form->create('Event'); ?>
		<?php echo $this->Form->input('user_id', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('location_id', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('start_date', array('class' => 'form-control', 'div' => array('class' => 'control-group form-inline'), 'minYear' => date('Y'), 'maxYear' => date('Y') + 1, 'interval' => 5)); ?>
		<br />
		<?php echo $this->Form->input('capacity', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('price', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
		<br />
		<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Form->end(); ?>

	</div>
</div>