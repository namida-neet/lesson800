<h2>テストだよ〜</h2>
<ul>
<?php foreach ($minibbsPosts as $post) : ?>
<li>
    <?= h($post->messages) ?>
    <?= h($post->user->username) ?>
    <?= $this->Html->link('view', ['action' => 'view', $post->id]) ?>
</li>
<?php endforeach; ?>
</ul>
