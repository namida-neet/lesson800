<div class="post-area">
    <div class="user-info">
        <p class="user-icon">
            <img src="" alt="">
        </p>
        <p class="user-name">
            <?= $authuser['username'] ?>
        </p>
    </div><!-- user-info -->

    <!-- 投稿フォーム -->
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
    <!-- 投稿フォームここまで -->
</div><!-- post-area -->

<!-- 投稿一覧表示 -->
<?php foreach ($minibbsPosts as $minibbsPost): ?>
<div class="msg">
    <img src="" alt="<?= h($minibbsPost->user->username) ?>のアイコン" width="48" height="48">
    <p class="post-message">
        <?= h($minibbsPost->messages) ?>
        <?php if (h($minibbsPost->created) !== h($minibbsPost->modified)) : ?>
            <span class="edit-message">（編集済）</span>
        <?php endif; ?>
        <span class="name"> [ <?= h($minibbsPost->user->username) ?> ] </span>
        <span class="post-number">No.<?= $this->Number->format($minibbsPost->id) ?></span>
    </p>

    <div class="post-description">
        <p class="day">
            <?= $this->Html->link(h($minibbsPost->created), ['action' => 'view', $minibbsPost->id]) ?>
        </p>

        <?php if ($minibbsPost->reply_message_id !== null) : ?>
        <p class="reply_message">
            <?= $this->Html->link(__('返信元のメッセージ'), ['action' => 'view', $minibbsPost->reply_message_id]) ?>
        </p>
        <?php endif; ?>
    </div><!-- post-description -->
    <div class="reaction-tools">
        <p class="res-button">
            <?= $this->Html->link(__('Reply'), [
                'action' => 'index',
                '?' => ['reply' => $minibbsPost->id],
            ]) ?>
        </p>
        <p class="res-button">
            <a href="">Repost</a>
        </p>
        <p class="favorite">
            <a href="">は</a>
        </p>
        <p class="favCount">
            か
        </p>
        <p class="star">
            <a href="">す</a>
        </p>
        <p class="starAverage">
            か
        </p>
        <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $minibbsPost->user->id) : ?>
        <div class="delete-button">
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $minibbsPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $minibbsPost->id)]) ?>
        </div>
        <?php endif; ?>
    </div><!-- reaction-tools -->
</div><!-- msg -->
<?php endforeach; ?>
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
