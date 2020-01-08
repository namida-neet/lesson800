<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Star[]|\Cake\Collection\CollectionInterface $stars
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Star'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stars index large-9 medium-8 columns content">
    <h3><?= __('Stars') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('star_score') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stars as $star): ?>
            <tr>
                <td><?= $this->Number->format($star->id) ?></td>
                <td><?= $star->has('user') ? $this->Html->link($star->user->id, ['controller' => 'Users', 'action' => 'view', $star->user->id]) : '' ?></td>
                <td><?= $star->has('post') ? $this->Html->link($star->post->id, ['controller' => 'Posts', 'action' => 'view', $star->post->id]) : '' ?></td>
                <td><?= $this->Number->format($star->star_score) ?></td>
                <td><?= h($star->created) ?></td>
                <td><?= h($star->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $star->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $star->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $star->id], ['confirm' => __('Are you sure you want to delete # {0}?', $star->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
