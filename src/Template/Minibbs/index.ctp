<div class="post-area">
    <div class="user-info">
        <p class="user-icon">
            <img src="" alt="">
        </p>
        <p class="user-name">
            <?= $authuser['username'] ?>
        </p>
    </div><!-- user-info -->

    <!--投稿フォーム-->
    <?= $this->Form->create($post, [
        'type' => 'post',
        'url' => [
            'controller' => 'Minibbs',
            'action' => 'index',
        ],
        'class' => 'bbs-form',
    ]) ?>
    <?= $this->Form->control('Posts.messages', [
        'label' => false,
        'class' => 'bbs-textarea',
    ]) ?>
    <?php if (isset($post->reply_message_id)) : ?>
        <?= $this->Form->hidden('Posts.reply_message_id', [
            'value' => $post->reply_message_id,
        ]) ?>
    <?php endif; ?>
    <?= $this->Form->submit(__('Submit'), [
        'class' => [
            'submit-button',
            '-bbs-message',
        ],
    ]) ?>
    <?= $this->Form->end() ?>
    <!--投稿フォームここまで-->

</div><!-- post-area -->











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
