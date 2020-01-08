<?= $this->Form->create($user, [
    'class' => 'signup-form',
]) ?>
<?= $this->Form->control('username', [
    'label' => [
        'class' => [
            'label-name',
            'uppercase'
        ],
    ],
]) ?>
<?= $this->Form->control('password', [
    'label' => [
        'class' => [
            'label-name',
            'uppercase'
        ],
    ],
]) ?>
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
<?= $this->Form->end() ?>
