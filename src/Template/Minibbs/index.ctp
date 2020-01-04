<div class="posts index large-9 medium-8 columns content">
    <h4>ログインしているのは<?= $authuser['username'] ?>です</h4>
<!--投稿フォーム-->
    <div class="posts form large-9 medium-8 columns content">
        <?= $this->Form->create($post, [
            'type' => 'post',
            'url' => [
                'controller' => 'Minibbs',
                'action' => 'index',
            ],
        ]) ?>
        <fieldset>
            <legend><?= __('Add Post') ?></legend>
            <?= $this->Form->control('Posts.messages') ?>
            <?php if (isset($post->reply_message_id)) : ?>
                <?= $this->Form->hidden('Posts.reply_message_id', ['value' => $post->reply_message_id]) ?>
            <?php endif; ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
<!--投稿フォームここまで-->
<!--投稿一覧表示-->
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('messages') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('reply_message_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('repost_message_id') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($minibbsPosts as $minibbsPost): ?>
            <tr>
                <td><?= $this->Number->format($minibbsPost->id) ?></td>
                <td>
                    <?= h($minibbsPost->messages) ?>
                    <?php if (h($minibbsPost->created) !== h($minibbsPost->modified)) : ?>
                        （編集済）
                    <?php endif; ?>
                </td>
                <td><?= $minibbsPost->has('user') ? $this->Html->link($minibbsPost->user->username, ['controller' => 'Users', 'action' => 'view', $minibbsPost->user->id]) : '' ?></td>
                <td><?= $this->Number->format($minibbsPost->reply_message_id) ?></td>
                <td><?= $this->Number->format($minibbsPost->reminibbsPost_message_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $minibbsPost->id]) ?>

                    <?php if ($minibbsPost->reply_message_id !== null) : ?>
                    <?= $this->Html->link(__('返信元のメッセージ'), ['action' => 'view', $minibbsPost->reply_message_id]) ?>
                    <?php endif; ?>

                    <?= $this->Html->link(__('Reply'), [
                        'action' => 'index',
                        '?' => ['reply' => $minibbsPost->id],
                    ]) ?>

                    <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $minibbsPost->user->id) : ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $minibbsPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minibbsPost->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<!--投稿一覧表示ここまで-->
<!--ページネーション-->
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
<!--ページネーションここまで-->
</div>
