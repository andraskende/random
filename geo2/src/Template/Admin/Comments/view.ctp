<div class="comments view">
	<h2><?= __('Comment') ?></h2>
	<dl>
		<dt><?= __('Id') ?></dt>
		<dd>
			<?= h($comment->id) ?>
			&nbsp;
		</dd>
		<dt><?= __('Name') ?></dt>
		<dd>
			<?= h($comment->name) ?>
			&nbsp;
		</dd>
		<dt><?= __('Phone') ?></dt>
		<dd>
			<?= h($comment->phone) ?>
			&nbsp;
		</dd>
		<dt><?= __('Email') ?></dt>
		<dd>
			<?= h($comment->email) ?>
			&nbsp;
		</dd>
		<dt><?= __('Message') ?></dt>
		<dd>
			<?= h($comment->message) ?>
			&nbsp;
		</dd>
		<dt><?= __('Memo') ?></dt>
		<dd>
			<?= h($comment->memo) ?>
			&nbsp;
		</dd>
		<dt><?= __('Active') ?></dt>
		<dd>
			<?= h($comment->active) ?>
			&nbsp;
		</dd>
		<dt><?= __('Referer') ?></dt>
		<dd>
			<?= h($comment->referer) ?>
			&nbsp;
		</dd>
		<dt><?= __('Created') ?></dt>
		<dd>
			<?= h($comment->created) ?>
			&nbsp;
		</dd>
		<dt><?= __('Modified') ?></dt>
		<dd>
			<?= h($comment->modified) ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # %s?', $comment->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?> </li>
	</ul>
</div>
