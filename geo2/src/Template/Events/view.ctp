<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb($event->location->name, '/rink/' . $event->slug); ?>
<?php $this->Html->addCrumb($this->Time->format($event->start_date), '/events/view/' . $event->id); ?>

<h3>Event Details</h3>

<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<td>Location</td>
		<td>
			<?php echo $this->Html->link($event->location->name, array('controller' => 'Locations', 'action' => 'view', 'slug' => $event->location->slug)); ?>
			<br />
			<?php echo h($event->location->address); ?></br>
			<?php echo h($event->location->city); ?>, <?php echo h($event->location->state); ?> <?php echo h($event->location->zip_code); ?></br>
			<?php echo h($event->location->phone); ?></br>
			<?php echo $this->Html->link($event->location->website, $event->location->website, array('target' => '_blank')); ?>
		</td>
	</tr>
	<tr>
		<td>Start Date</td>
		<td><?php echo $this->Time->format($event->start_date); ?></td>
	</tr>
	<tr>
		<td>Organizer</td>
		<td>
			<?php echo $this->Html->link($event->user->name, array('controller' => 'Users', 'action' => 'profile', 'slug' => $event->user->slug)); ?>
			<br />
			<?php echo $event->user->phone; ?>
			<br />
			<?php echo $event->user->email; ?>
		</td>
	</tr>
	<tr>
		<td>Capacity</td>
		<td><?php echo h($event->capacity); ?></td>
	</tr>
	<tr>
		<td>Existing Registrations</td>
		<td><?php echo $registrations->count(); ?></td>
	</tr>
	<tr>
		<td>Remaining Spots</td>
		<td><?php echo $event->capacity - $registrations->count(); ?></td>
	</tr>
	<tr>
		<td>Price</td>
		<td>$<?php echo h($event->price); ?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><?php echo h($event->description); ?></td>
	</tr>
</table>

<br />
<br />

<?php if(isset($authuser) && empty($registration) && !empty($play_as)): ?>

	<div class="well well-sm">
	<h3>Register for this Event</h3>

	Player: <?php echo $authuser['name']; ?>
	<br />

	<?php echo $this->Form->create('Registration', array('class' => 'form-inline')); ?>
	<?php echo $this->Form->hidden('id', array('value' => $event->id)); ?>
	<!-- <div class="row">
	<div class="col-sm-3"> -->
	<?php echo $this->Form->input('play_as', array('class' => 'form-control', 'options' => $play_as)); ?>
	<!-- </div>
	</div> -->
	<?php echo $this->Form->input('active1', array('type' => 'checkbox', 'label' => 'I agree to the kende.com terms and waiver', 'required' => true)); ?>
	<br />
	<?php echo $this->Form->input('active2', array('type' => 'checkbox', 'label' => 'I agree to the organizer terms and waiver', 'required' => true)); ?>
	<br />
	<br />
	<?php echo $this->Form->button('Register', array('class' => 'btn btn-primary')); ?>
	<?php echo $this->Form->end(); ?>
	</div>

<?php elseif(isset($authuser) && !empty($registration)): ?>

	<div class="row">
	<div class="col-sm-5">
	<div class="alert alert-success">
		<span class="glyphicon glyphicon-thumbs-up"></span> You already registered to this event!
	</div>
	</div>
	</div>

	<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove-circle"></span> Cancel Registration', array('controller' => 'Registrations', 'action' => 'delete', $registration->id), array('class' => 'btn btn-danger', 'escape' => false), 'Are you sure you want to cancel your registration ?'); ?>

<?php else: ?>
	<?php echo $this->Html->link('<span class="glyphicon glyphicon-check"></span> Register ', array('controller' => 'Users', 'action' => 'event', $event->id), array('class' => 'btn btn-primary btn-md', 'escape' => false)); ?>
<?php endif; ?>

<br />
<br />

<?php if (!empty($registrations)): ?>

	<h3>Skaters</h3>

	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Attendee</th>
		<th>Registration date</th>
		<th>Status</th>
	</tr>
	<?php foreach ($registrations as $registration): ?>
		<tr>
			<td><?php echo $registration->user->name; ?></td>
			<td><?php echo $registration->created; ?></td>
			<td><?php echo $registration->status; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>

<?php endif; ?>

<br />
<br />

<?php if (!empty($goaltenders)): ?>

	<h3>Goaltenders</h3>

	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Attendee</th>
		<th>Registration date</th>
		<th>Status</th>
	</tr>
	<?php foreach ($goaltenders as $goaltender): ?>
		<tr>
			<td><?php echo $goaltender->user->name; ?></td>
			<td><?php echo $goaltender->created; ?></td>
			<td><?php echo $goaltender->status; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>

<?php endif; ?>

<br />
<br />

<?php if (!empty($deletedregistrations)): ?>

	<h3>Cancelled Registrations</h3>

	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Attendee</th>
		<th>Play as</th>
		<th>Registration date</th>
	</tr>
	<?php foreach ($deletedregistrations as $deletedregistration): ?>
		<tr>
			<td><?php echo $deletedregistration->user->name; ?></td>
			<td><?php echo $deletedregistration->play_as; ?></td>
			<td><?php echo $deletedregistration->created; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>

<?php endif; ?>
