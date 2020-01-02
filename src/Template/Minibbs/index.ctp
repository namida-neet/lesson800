<div class="posts index large-9 medium-8 columns content">
    <h3><?= __('Posts') ?></h3>
    <h4>ログインしているのは<?= $authuser['username'] ?>です</h4>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('messages') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('reply_message_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('repost_message_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= $this->Number->format($post->id) ?></td>
                <td>
                    <?= h($post->messages) ?>
                    <?php if (h($post->created) !== h($post->modified)) : ?>
                        （編集済）
                    <?php endif; ?>
                </td>
                <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
                <td><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
                <td><?= $this->Number->format($post->reply_message_id) ?></td>
                <td><?= $this->Number->format($post->repost_message_id) ?></td>
                <td><?= h($post->created) ?></td>
                <td><?= h($post->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>
                    <?= $this->Html->link(__('Reply'), ['action' => 'reply', $post->id]) ?>
                    <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user->id) : ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
