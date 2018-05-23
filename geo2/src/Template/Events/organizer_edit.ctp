<link rel="stylesheet" href="/select2/select2.css" type="text/css">
<link rel="stylesheet" href="/select2/select2-bootstrap.css">
<script src="/select2/select2.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	$("#EventLocationId").select2();

});

</script>

<h2>Edit Event</h2>

<div class="row">
	<div class="col-sm-5">

		<?php echo $this->Form->create('Event', array()); ?>
		<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
		<?php echo $this->Form->input('location_id', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('start_date', array('class' => 'form-control', 'div' => array('class' => 'control-group form-inline'), 'minYear' => date('Y'), 'maxYear' => date('Y') + 1, 'interval' => 5)); ?>
		<br />

		<?php //echo $this->Form->year('start_date', 2014, 2016, array('label' => 'Year', 'class' => 'form-control', 'div' => array('class' => 'control-group form-inline'))); ?>
		<?php // echo $this->Form->month('start_date', array('class' => 'form-control', 'empty' => "MONTH")); ?>
		<?php // echo $this->Form->day('start_date', array('class' => 'form-control', 'empty' => 'DAY')); ?>

		<?php echo $this->Form->input('capacity', array('class' => 'form-control', 'options' => $this->App->capacities())); ?>
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

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('View Event', array('action' => 'view', $event['Event']['id']), array('class' => 'btn btn-default')); ?>

<br />
<br />
