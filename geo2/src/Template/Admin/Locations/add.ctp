<div class="locations form">
<?= $this->Form->create($location) ?>
	<fieldset>
		<legend><?= __('Add Location'); ?></legend>
	<?php
		echo $this->Form->input('placeid');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
		echo $this->Form->input('description');
		echo $this->Form->input('formatted_address');
		echo $this->Form->input('reference');
		echo $this->Form->input('vicinity');
		echo $this->Form->input('active');
		echo $this->Form->input('response');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('lat');
		echo $this->Form->input('lng');
		echo $this->Form->input('views');
		echo $this->Form->input('email');
		echo $this->Form->input('website');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
<div class="actions">
	<h3><?= __('Actions') ?></h3>
	<ul>
		<li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?></li>
	</ul>
</div>
