<?= $this->Form->create($post, [
    'type' => 'post',
    'url' => [
        'controller' => 'Posts',
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
