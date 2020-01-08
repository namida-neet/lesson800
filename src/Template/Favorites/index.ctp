<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorite[]|\Cake\Collection\CollectionInterface $favorites
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Favorite'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="favorites index large-9 medium-8 columns content">
    <h3><?= __('Favorites') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('favorite_score') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($favorites as $favorite): ?>
            <tr>
                <td><?= $this->Number->format($favorite->id) ?></td>
                <td><?= $favorite->has('user') ? $this->Html->link($favorite->user->id, ['controller' => 'Users', 'action' => 'view', $favorite->user->id]) : '' ?></td>
                <td><?= $favorite->has('post') ? $this->Html->link($favorite->post->id, ['controller' => 'Posts', 'action' => 'view', $favorite->post->id]) : '' ?></td>
                <td><?= $this->Number->format($favorite->favorite_score) ?></td>
                <td><?= h($favorite->created) ?></td>
                <td><?= h($favorite->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $favorite->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $favorite->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $favorite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $favorite->id)]) ?>
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
