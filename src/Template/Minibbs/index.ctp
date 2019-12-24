<p>いまログインしているのは<?= $authuser['username'] ?>です</p>
<p><?= $this->Html->link('ログアウト', ['action' => 'logout']) ?></p>

<?= $this->Form->create($postEntity, [
    'type' => 'post',
    'url' => [
        'controller' => 'Minibbs',
        'action' => 'index',
    ],
]) ?>
<fieldset>
<?= $this->Form->hidden('Posts.user_id', ['value' => $authuser['id']]) ?>
<?= $this->Form->control('Posts.messages') ?>
<?= $this->Form->submit('かきこむ！！！') ?>
</fieldset>
<?= $this->Form->end() ?>

<div>
    <ul>
    <?php foreach ($minibbsPosts as $post) : ?>
    <li>
        <?= h($post->messages) ?>
        <?= h($post->user->username) ?>
        <?= h($post->id) ?>
        <?= $this->Html->link($post->modified, ['action' => 'view', $post->id]) ?>
        <?= $this->Html->link('返信', ['action' => 'reply', $post->id]) ?>
        <?= $this->Html->link('シェア', ['action' => 'repost', $post->id]) ?>
        <?= $this->Html->link('ハート', ['action' => 'favorite', $post->id]) ?>
        <?= $this->Html->link('星', ['action' => 'star', $post->id]) ?>
        <?= $this->Html->link('削除', ['action' => 'delete', $post->id]) ?>
    </li>
    <?php endforeach; ?>
    </ul>
</div>
