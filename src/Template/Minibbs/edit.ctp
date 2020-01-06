<?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user_id) : ?>
<p>編集する</p>
<?= $this->Form->create($post, [
    'class' => 'bbs-form',
]) ?>
<?= $this->Form->control('messages', [
    'label' => false,
    'class' => 'bbs-textarea',
]) ?>
<?= $this->Form->submit(__('Submit'), [
    'class' => [
        'submit-button',
        '-bbs-message',
    ],
]) ?>
<?= $this->Form->end() ?>
<?php else : ?>
<p>この記事を編集する権限がありません。</p>
<?php endif; ?>
<p>
    <?= $this->Html->link(__('戻る'), [
        'action' => 'view',
        $post->id
    ], [
        'class' => 'cancel-button',
    ]) ?>
</p>
