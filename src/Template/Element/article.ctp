<div class="msg">
<?php if ($minibbsPost->user->icon_file_name === null) : ?>
    <?= $this->Html->image('user-icon/' . '100x100.png', ['alt' => $minibbsPost->user->username . 'のアイコン']); ?>
<?php else : ?>
    <?= $this->Html->image('user-icon/' . $minibbsPost->user->icon_file_name, ['alt' => $minibbsPost->user->username . 'のアイコン']); ?>
<?php endif; ?>
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
        <?= $this->Html->link(h($minibbsPost->created->i18nFormat('yyyy-MM-dd HH:mm:ss')), [
            'action' => 'view',
            $minibbsPost->id
        ]) ?>
        </p>

    <?php if ($minibbsPost->reply_message_id !== null) : ?>
        <p class="reply_message">
            <?= $this->Html->link(__('返信元のメッセージ'), [
                'action' => 'view',
                $minibbsPost->reply_message_id
            ]) ?>
        </p>
    <?php endif; ?>
    </div><!-- post-description -->
    <div class="reaction-tools">
    <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $minibbsPost->user->id) : ?>
        <div class="delete-button">
            <?= $this->Form->postLink(__('Delete'), [
                'action' => 'delete',
                $minibbsPost->id
            ], [
                'confirm' => __('Are you sure you want to delete # {0}?', $minibbsPost->id)
            ]) ?>
        </div>
    <?php endif; ?>
        <p class="res-button">
            <?= $this->Html->link(__('Reply'), [
                'action' => 'index',
                '?' => ['reply' => $minibbsPost->id],
            ]) ?>
        </p>
        <?= $this->element('favorite', ['minibbsPost' => $minibbsPost]) ?>
        <?= $this->element('star', ['minibbsPost' => $minibbsPost]) ?>
    </div><!-- reaction-tools -->
</div><!-- msg -->
