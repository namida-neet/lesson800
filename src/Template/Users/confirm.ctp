<?= $this->Form->create('', [
    'url' => [
        'action' => 'signup',
    ],
]) ?>
<dl>
    <dt class="uppercase">username</dt>
    <dd><?= h($checkdata['username']) ?></dd>
    <?= $this->Form->hidden('username', [
        'value' => $checkdata['username'],
    ]) ?>
    <dt class="uppercase">password</dt>
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
<?= $this->Form->end() ?>
<?= $this->Html->link(__('戻る'), ['action' => 'signup']) // 変更する ?>
