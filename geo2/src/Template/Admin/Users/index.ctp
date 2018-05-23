<script>

$(document).ready(function() {

    $('.name').editable({
        type: 'text',
        name: 'name',
        url: '/admin/users/editable',
        title: 'Name',
        placement: 'right',
    });

    $('.slug').editable({
        type: 'text',
        name: 'slug',
        url: '/admin/users/editable',
        title: 'Slug',
        placement: 'right',
    });

    $('.first_name').editable({
        type: 'text',
        name: 'first_name',
        url: '/admin/users/editable',
        title: 'First Name',
        placement: 'right',
    });

    $('.last_name').editable({
        type: 'text',
        name: 'last_name',
        url: '/admin/users/editable',
        title: 'Last Name',
        placement: 'right',
    });

    $('.email').editable({
        type: 'text',
        name: 'email',
        url: '/admin/users/editable',
        title: 'Email',
        placement: 'right',
    });

    $('.phone').editable({
        type: 'text',
        name: 'phone',
        url: '/admin/users/editable',
        title: 'Phone',
        placement: 'right',
    });

    $('.notes').editable({
        type: 'textarea',
        name: 'notes',
        url: '/admin/users/editable',
        title: 'Notes',
        placement: 'left',
    });

});

</script>

<h2>Users</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('id');?></th>
        <th><?php echo $this->Paginator->sort('role');?></th>
        <th><?php echo $this->Paginator->sort('name');?></th>
        <th><?php echo $this->Paginator->sort('slug');?></th>
        <th><?php echo $this->Paginator->sort('phone');?></th>
        <th><?php echo $this->Paginator->sort('email');?></th>
        <th><?php echo $this->Paginator->sort('logins');?></th>
        <th><?php echo $this->Paginator->sort('last_login');?></th>
        <th><?php echo $this->Paginator->sort('active');?></th>
        <th><?php echo $this->Paginator->sort('created');?></th>
        <th><?php echo $this->Paginator->sort('modified');?></th>
        <th class="actions">Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo h($user->id); ?></td>
        <td><?php echo h($user->role); ?></td>
        <td><span class="name" data-value="<?php echo $user->name; ?>" data-pk="<?php echo $user->id; ?>"><?php echo $user->name; ?></span></td>
        <td><span class="slug" data-value="<?php echo $user->slug; ?>" data-pk="<?php echo $user->id; ?>"><?php echo $user->slug; ?></span></td>
        <td><span class="phone" data-value="<?php echo $user->phone; ?>" data-pk="<?php echo $user->id; ?>"><?php echo $user->phone; ?></span></td>
        <td><span class="email" data-value="<?php echo $user->email; ?>" data-pk="<?php echo $user->id; ?>"><?php echo $user->email; ?></span></td>
        <td><?php echo h($user->logins); ?></td>
        <td><?php echo h($user->last_login); ?></td>
        <td><?php echo $this->Html->link($this->Html->image('icon_' . $user->active . '.png'), array('controller' => 'users', 'action' => 'switch', 'active', $user->id), array('class' => 'switch', 'escape' => false)); ?></td>
        <td><?php echo h($user->created); ?></td>
        <td><?php echo h($user->modified); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $user->id), ['class' => 'btn btn-default btn-xs']); ?>
            <?php echo $this->Html->link('Change Password', array('action' => 'password', $user->id), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user->id), array('class' => 'btn btn-default btn-xs')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination'); ?>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('New User', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />
