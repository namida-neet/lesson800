<?= $this->Form->create('', [
    'class' => 'login-form',
]) ?>
<?= $this->Form->control('username', [
    'label' => [
        'class' => [
            'label-name',
            'uppercase',
        ],
    ],
]) ?>
<?= $this->Form->control('password', [
    'label' => [
        'class' => [
            'label-name',
            'uppercase',
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
