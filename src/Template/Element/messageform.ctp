<?= $this->Form->create($post, [
    // 'type' => 'post',
    // 'url' => [
    //     'controller' => 'Posts',
    //     'action' => 'index',
    // ],
    'class' => 'bbs-form',
]) ?>
<?= $this->Form->control('messages', [
    'type' => 'text',
    'label' => false,
    'maxLength' => 255,
    'class' => 'bbs-textarea',
]) ?>
<?php if (isset($post->reply_message_id)) : ?>
    <?= $this->Form->hidden('reply_message_id', [
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
