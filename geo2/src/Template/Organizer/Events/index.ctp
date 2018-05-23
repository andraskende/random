<h2>Events</h2>

<div class="table-responsive">

<table class="table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('location_id') ?></th>
            <th><?= $this->Paginator->sort('start_date') ?></th>
            <th><?= $this->Paginator->sort('end_date') ?></th>
            <th><?= $this->Paginator->sort('timezone') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $this->Number->format($event->id) ?></td>
            <td>
                <?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?>
            </td>
            <td>
                <?= $event->has('location') ? $this->Html->link($event->location->name, ['controller' => 'Locations', 'action' => 'view', $event->location->id]) : '' ?>
            </td>
            <td><?= h($event->start_date) ?></td>
            <td><?= h($event->end_date) ?></td>
            <td><?= h($event->timezone) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $event->id],['class' => 'btn btn-default btn-xs']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id], ['class' => 'btn btn-default btn-xs']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['class' => 'btn btn-default btn-xs', 'confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

</div>

<?php echo $this->element('pagination'); ?>


<br />
<br />

<h3><?= __('Actions') ?></h3>

<?= $this->Html->link(__('New Event'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
<br />

