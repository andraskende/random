<?php $this->Html->addCrumb('Home', 'http://www.kende.com'); ?>


<h1>Ice Hockey Pickup Games</h1>

<h4>Welcome to Ice Hockey Pickup ! Organize and Manage your Ice Hockey Pickup games.</h4>

Join the revolution, the new way to organize hockey pick up games, have less stress and more fun! First 10 organizers will get free service for a lifetime.
<br />
<br />
The website has been created to help ice hockey venues and individuals to organize hockey pick up games.
<br />
<br />
The mission: Bringing the pick up games to a new, more organized level.
<br />
<br />
How do we envision achieving this? Through the following functions:
<br />
<br />
1. The organizer has ability to import his contacts, and keep them organized in one place.

<br />
2. The e-mail notification will automatically be sent to all players in the group and to the organizer, notifying of any changes in upcoming pick up.
<br />
3.  Everybody has visibility how the pick up is forming, who is attending, etc.
<br />
4.  We strongly recommend for organizers to implement following policies/rules witch which are embedded into the site:
<br />
&nbsp; -  declare the maximum number of players and turn down any last minute appearance without prior registration and confirmation from the organizer through the site
<br />
&nbsp; - declare your cancelation policy, for example 6 hours before the pick up starts
<br />
&nbsp; - have a “unreliable” list of players, who have canceled in the past after the cancelation policy time, or do not show up at all, after being confirmed
<br />
&nbsp; - have a waiting list, witch is consists of players who are:
<br />
&nbsp; &nbsp; * not confirmed yet, simply waiting for organizer confirmation
<br />
&nbsp; &nbsp; * extra players, who apply for the game after the roster has been filled
<br />
&nbsp; &nbsp; *  “unreliable” list
<br />

5. We are planning to implement PayPal prepayment option soon, witch which will allow non cash payments and will automate confirmation. Those who already made a prepayment, will be automatically confirmed.
<br />
<br />
This is Beta version of site, we will appreciate any feedback. Happy pick up games!
<br />
<br />
The team.
<br />

<p align="center">
	<a href="/users/signup" class="btn btn-success" role="button">Sign up either as an organizer or hockey player</a>
</p>


<br />

<table class="table-striped table-bordered table-condensed table-hover" id="mapresult">
	<?php foreach ($locations as $location): ?>
	<tr>
		<td><?php echo $this->Html->link($location->name, array('controller' => 'Locations', 'action' => 'view', 'slug' => $location->slug)); ?></td>
		<td><?php echo $location->address; ?> <?php echo $location->city; ?>, <?php echo $location->state; ?>, <?php echo $location->postal_code; ?></td>
		<td><?php echo $location->phone; ?></td>
	</tr>
	<?php endforeach; ?>
</table>