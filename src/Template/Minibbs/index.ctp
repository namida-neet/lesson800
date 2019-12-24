<p>いまログインしているのは<?= $authuser['username'] ?>です</p>
<p><?= $this->Html->link('ログアウト', ['action' => 'logout']) ?></p>
<p>
メッセージの投稿フォームが必要<br>
メッセージの投稿フォームが必要<br>
メッセージの投稿フォームが必要<br>
メッセージの投稿フォームが必要<br>
メッセージの投稿フォームが必要<br>
メッセージの投稿フォームが必要<br>
</p>
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
