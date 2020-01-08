<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Star $star
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $star->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $star->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stars'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stars form large-9 medium-8 columns content">
    <?= $this->Form->create($star) ?>
    <fieldset>
        <legend><?= __('Edit Star') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('post_id', ['options' => $posts]);
            echo $this->Form->control('star_score');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
