<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="events view large-10 medium-9 columns">
    <h2><?= h($event->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $event->has('user') ? $this->Html->link($event->user->name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $event->has('location') ? $this->Html->link($event->location->name, ['controller' => 'Locations', 'action' => 'view', $event->location->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Timezone') ?></h6>
            <p><?= h($event->timezone) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($event->id) ?></p>
            <h6 class="subheader"><?= __('Capacity') ?></h6>
            <p><?= $this->Number->format($event->capacity) ?></p>
            <h6 class="subheader"><?= __('Price') ?></h6>
            <p><?= $this->Number->format($event->price) ?></p>
            <h6 class="subheader"><?= __('Active') ?></h6>
            <p><?= $this->Number->format($event->active) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start Date') ?></h6>
            <p><?= h($event->start_date) ?></p>
            <h6 class="subheader"><?= __('End Date') ?></h6>
            <p><?= h($event->end_date) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($event->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($event->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($event->description)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Registrations') ?></h4>
    <?php if (!empty($event->registrations)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Event Id') ?></th>
            <th><?= __('Location Id') ?></th>
            <th><?= __('Play As') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Memo') ?></th>
            <th><?= __('Status') ?></th>
            <th><?= __('Active') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($event->registrations as $registrations): ?>
        <tr>
            <td><?= h($registrations->id) ?></td>
            <td><?= h($registrations->user_id) ?></td>
            <td><?= h($registrations->event_id) ?></td>
            <td><?= h($registrations->location_id) ?></td>
            <td><?= h($registrations->play_as) ?></td>
            <td><?= h($registrations->price) ?></td>
            <td><?= h($registrations->memo) ?></td>
            <td><?= h($registrations->status) ?></td>
            <td><?= h($registrations->active) ?></td>
            <td><?= h($registrations->created) ?></td>
            <td><?= h($registrations->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Registrations', 'action' => 'view', $registrations->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Registrations', 'action' => 'edit', $registrations->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Registrations', 'action' => 'delete', $registrations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrations->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
