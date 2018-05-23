<?php $this->Html->addCrumb('Home', '/'); ?>
<?php $this->Html->addCrumb('Contact', '/contact'); ?>

<h1>Contact</h1>

<h4>Send Us a Message</h4>

<br />

<div class="row">
	<div class="col-sm-6">
		<?php echo $this->Form->create($comment);?>
		<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
		<br />
		<?php echo $this->Form->input('message', array('rows' => 5, 'class' => 'form-control', 'label' => 'Message')); ?>
		<br />
		<?php echo $this->Form->input('hash', array('type' => 'hidden', 'value' => $hash)); ?>
		<div class="input-group">
			<span class="input-group-addon"><?php echo $n1 . ' + ' . $n2 . ' = '; ?></span>
			<?php echo $this->Form->input('captcha', array('type' => 'text', 'label' => false, 'div' => false, 'placeholder' => '?', 'class' => 'form-control', 'required' => true)); ?>
		</div>
		<br />
		<?php echo $this->Form->button('<span class="glyphicon glyphicon-send"></span> Submit', array('class' => 'btn btn-primary'));?>
		<?php echo $this->Form->end(); ?>
		<br />
	</div>
</div>
