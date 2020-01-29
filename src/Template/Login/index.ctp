<?= $this->Form->create('', [
    'class' => 'login-form',
]) ?>
<?php if (!empty($this->request->session())) : ?>
    <!-- ユーザー登録画面から来た場合はあらかじめユーザー名を入れる -->
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
<?= $this->Form->submit(__('Login'), [
    'class' => [
        'submit-button',
        '-login',
    ],
]) ?>
<?= $this->Form->end() ?>
