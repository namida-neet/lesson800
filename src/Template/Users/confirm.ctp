<?= $this->Form->create('', [
    'url' => [
        'action' => 'signup',
    ],
]) ?>
<dl>
    <dt>Username</dt>
    <dd><?= h($checkdata['username']) ?></dd>
    <?= $this->Form->hidden('username', [
        'value' => $checkdata['username'],
    ]) ?>
    <dt>Password</dt>
    <dd><?= '********' ?></dd>
    <?= $this->Form->hidden('password', [
        'value' => $checkdata['password'],
    ]) ?>
</dl>
<?= $this->Form->hidden('role',[
    'value' => $checkdata['role'],
]) ?>
<?= $this->Form->hidden('mode', [
    'value' => 'savedata',
]) ?>
<?= $this->Form->button(__('OK'), [
    'class' => [
        'submit-button',
        '-ok',
    ],
]) ?>
<?= $this->Html->link(__('Return'), ['action' => 'signup'], ['class' => 'cancel-button',]) ?>
<?= $this->Form->end() ?>
