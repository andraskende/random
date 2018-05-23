<?php $this->Html->addCrumb('Home', 'http://www.kende.com/'); ?>
<?php $this->Html->addCrumb($location->name, '/rink/' . $location->slug); ?>

<div itemscope itemtype="http://schema.org/LocalBusiness">

<h1><?php echo h($location->name); ?></h1>

<p><?php echo $location->description; ?></p>

<strong itemprop="name"><?php echo h($location->name); ?></strong>
<br />

<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
<span itemprop="streetAddress"><?php echo $location->address; ?></span>
<br />
<span itemprop="addressLocality"><?php echo h($location->city); ?></span>, <span itemprop="addressRegion"><?php echo h($location->state); ?></span> <span itemprop="postalCode"><?php echo $location->postal_code; ?></span>
</address>

<span class="glyphicon glyphicon-phone-alt"></span> <span itemprop="telephone"><?php echo h($location->phone); ?></span>

<br />

</div>

<?php if(!empty($location->website)) : ?>
<span class="glyphicon glyphicon-globe"></span> <?php echo $this->Html->link($location->website, $location->website); ?>
<br />
<?php endif; ?>


<?php if (!empty($events)): ?>

	<h3>Events</h3>

	<table class="table-striped table-bordered table-condensed table-hover">
	<tr>
		<th>Event Date</th>
		<th>Organizer</th>
		<th>Price</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($events as $event): ?>
		<tr>
			<td><?php echo $this->Time->format('l, F jS, Y h:i A', $event->start_date); ?></td>
			<td><?php echo $this->Html->link($event->user->name, array('controller' => 'users', 'action' => 'profile', 'slug' => $event['User']['slug'])); ?></td>
			<td>$<?php echo $event['Event']['price']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link('View', array('controller' => 'events', 'action' => 'view', $event['Event']['id']), array('class' => 'btn btn-default btn-sm')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>

<?php endif; ?>

<br />
<br />

<?php if(!empty($reviews)) : ?>
<h4><?php echo h($location->name); ?> Reviews:</h4>
<hr>
<?php foreach($reviews as $review) : ?>
<?php echo h($review['Review']['body']); ?>
<br />
<i><?php echo h($review['Review']['name']); ?> - <?php echo $this->Time->nice($review['Review']['created']); ?></i>
<hr>
<?php endforeach; ?>

<?php endif; ?>

<h4>Write a Review for <?php echo h($location->name); ?></h4>

<div class="row">
<div class="col-sm-4">

<?php echo $this->Form->create('Review'); ?>
<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Name')); ?>
<br />
<?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Email')); ?>
<br />
<?php echo $this->Form->input('body', array('rows' => 3, 'label' => false, 'class' => 'form-control', 'placeholder' => 'Write a Review for ' . $location->name)); ?>
<br />
<?php echo $this->Form->button('Submit a Review', array('class' => 'btn btn-primary btn-small')); ?>
<?php echo $this->Form->end(); ?>

</div>
</div>

<br />
<br />


<?php if($location->lat != 0) : ?>
<?php echo $this->Html->script(array('view.js'), array('inline' => false)); ?>
<div id="map1" style="width:90%; height:400px;"></div>
<input type="hidden" id="locationname" value="<?php echo $location->name; ?>" />
<input type="hidden" id="phone" value="<?php echo $location->phone; ?>" />
<input type="hidden" id="lat" value="<?php echo $location->lat; ?>" />
<input type="hidden" id="lng" value="<?php echo $location->lng; ?>" />
<input type="hidden" id="address" value="<?php echo $location->address; ?> <?php echo $location->city; ?> <?php echo $location->state; ?> <?php echo $location->postal_code; ?>" />
<?php endif; ?>

<br />
<br />
