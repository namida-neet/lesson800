<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $post->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Favorites'), ['controller' => 'Favorites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Favorite'), ['controller' => 'Favorites', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stars'), ['controller' => 'Stars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Star'), ['controller' => 'Stars', 'action' => 'add']) ?></li>
    </ul>
</nav>
<?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user_id) : ?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Edit Post') ?></legend>
        <?php
            echo $this->Form->control('messages');
//            echo $this->Form->control('user_id', ['options' => $users]);
//            echo $this->Form->control('reply_message_id');
//            echo $this->Form->control('repost_message_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php else : ?>
<div class="posts form large-9 medium-8 columns content">
    <p>この記事を編集する権限がありません。</p>
    <p><?= $this->Html->link(__('戻る'), ['action' => 'index']) ?></p>
</div>
<?php endif; ?>
