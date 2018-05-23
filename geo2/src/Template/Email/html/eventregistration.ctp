Dear <?php echo $user['name'];  ?>,

<br />
<br />

You are now registered for the following event: http://www.kende.com/event/<?php echo $event->id; ?>

<br />
<br />

<strong>Location:</strong><br />
<?php echo $event->location->name; ?><br />
<?php echo $event->location->address; ?><br />
<?php echo $event->location->city; ?>  <?php echo $event->location->state; ?>  <?php echo $event->location->zip_code; ?><br />
<?php echo $event->location->phone; ?><br />
<?php echo $event->location->website; ?><br />

<br />

<strong>Event Date:</strong><br />
<?php echo $this->Time->format($event->start_date); ?><br />

<br />

<strong>Organizer:</strong><br />
<?php echo $event->user->name; ?><br />
<?php echo $event->user->phone; ?><br />
<?php echo $event->user->email; ?><br />

<br />

<strong>Registration:</strong><br />
Skater : <?php echo $user['name']; ?><br />
Play as : <?php echo $registration->play_as; ?><br />
Price : $<?php echo $registration->price; ?><br />
Registration Date: <?php echo $this->Time->format($registration->created); ?><br />

<br />
<br />

http://www.kende.com

<br />
<br />

<?php //print_r($user); ?>

<br />
<br />

<?php //print_r($event); ?>


<?php //print_r($registration); ?>


