<?= $this->Form->create($post, [
    'class' => 'bbs-form',
]) ?>
<?= $this->Form->control('messages', [
    'type' => 'text',
    'label' => false,
    'maxLength' => 255,
    'class' => 'bbs-textarea',
    'onkeyup' => 'ShowLength(value);',
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
<p class="message-max-length"><span id="inputlength">0</span> / 50文字</p>
