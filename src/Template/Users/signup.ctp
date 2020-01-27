<?= $this->Form->create($user, [
    'type' => 'file',
    'class' => 'signup-form',
]) ?>
<?php if (! empty($this->request->session())) : ?><!-- 入力内容確認画面から戻った場合はユーザーネームを保持 -->
    <?= $this->Form->control('username', [
        'label' => [
            'class' => [
                'label-name',
            ],
        ],
        'value' => $this->request->session()->read('username'),
    ]) ?>
<?php else : ?>
    <?= $this->Form->control('username', [
        'label' => [
            'class' => [
                'label-name',
            ],
        ],
    ]) ?>
<?php endif; ?>
<?= $this->Form->control('password', [
    'label' => [
        'class' => [
            'label-name',
        ],
    ],
]) ?>
<div>
<label for="icon" class="label-name">icon</label>
    <div class="user-icon-dnd-wrapper">
        <div id="preview_field"></div>
        <div id="drop_area">drag and drop<br>or<br>click here.</div>
        <div id="icon_clear_button">X</div>
        <?= $this->Form->file('icon', [
            'id' => 'input_file',
            'accept' => 'image/*',
        ]) ?>
    </div>
</div>
<?= $this->Form->hidden('role',[
    'value' => 'author'
]) ?>
<?= $this->Form->hidden('mode', [
    'value' => 'confirm',
]) ?>
<?= $this->Form->button(__('Check'), [
    'class' => [
        'submit-button',
        '-signup',
    ],
]) ?>
<?= $this->Html->link(__('Return'), ['action' => 'login'], ['class' => 'cancel-button',]) ?>
<?= $this->Form->end() ?>
