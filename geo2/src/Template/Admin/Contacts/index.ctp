<div class="contacts index">
    <h2><?= __('Contacts') ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('user_id') ?></th>
        <th><?= $this->Paginator->sort('name') ?></th>
        <th><?= $this->Paginator->sort('phone') ?></th>
        <th><?= $this->Paginator->sort('email') ?></th>
        <th><?= $this->Paginator->sort('notes') ?></th>
        <th><?= $this->Paginator->sort('active') ?></th>
        <th><?= $this->Paginator->sort('created') ?></th>
        <th><?= $this->Paginator->sort('modified') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    <?php foreach ($contacts as $contact): ?>
    <tr>
        <td><?= h($contact->id) ?>&nbsp;</td>
        <td><?= h($contact->user_id) ?>&nbsp;</td>
        <td><?= h($contact->name) ?>&nbsp;</td>
        <td><?= h($contact->phone) ?>&nbsp;</td>
        <td><?= h($contact->email) ?>&nbsp;</td>
        <td><?= h($contact->notes) ?>&nbsp;</td>
        <td><?= h($contact->active) ?>&nbsp;</td>
        <td><?= h($contact->created) ?>&nbsp;</td>
        <td><?= h($contact->modified) ?>&nbsp;</td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id], ['class' => 'btn btn-default btn-xs']); ?>) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'btn btn-default btn-xs']); ?>) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['class' => 'btn btn-default btn-xs', 'confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
    <p><?= $this->Paginator->counter() ?></p>
    <ul class="pagination">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'));
        echo $this->Paginator->numbers();
        echo $this->Paginator->next(__('next') . ' >');
    ?>
    </ul>
</div>
<div class="actions">
    <h3><?= __('Actions') ?></h3>
    <ul>
        <li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?></li>
    </ul>
</div>
