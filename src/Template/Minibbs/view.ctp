<div class="posts view large-9 medium-8 columns content">
    <h3><?= h($post->id) ?></h3>
    <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user->id) : ?>
    <?= $this->Html->link(__('投稿を編集する'), ['action' => 'edit', $post->id]) ?>
    <?php endif; ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Messages') ?></th>
            <td><?= h($post->messages) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reply Message Id') ?></th>
            <td><?= $this->Number->format($post->reply_message_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Repost Message Id') ?></th>
            <td><?= $this->Number->format($post->repost_message_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($post->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($post->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Favorites') ?></h4>
        <?php if (!empty($post->favorites)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Post Id') ?></th>
                    <th scope="col"><?= __('Favorite Score') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($post->favorites as $favorites): ?>
                    <tr>
                        <td><?= h($favorites->id) ?></td>
                        <td><?= h($favorites->user_id) ?></td>
                        <td><?= h($favorites->post_id) ?></td>
                        <td><?= h($favorites->favorite_score) ?></td>
                        <td><?= h($favorites->created) ?></td>
                        <td><?= h($favorites->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Favorites', 'action' => 'view', $favorites->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Favorites', 'action' => 'edit', $favorites->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Favorites', 'action' => 'delete', $favorites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $favorites->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stars') ?></h4>
        <?php if (!empty($post->stars)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Post Id') ?></th>
                    <th scope="col"><?= __('Star Score') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($post->stars as $stars): ?>
                    <tr>
                        <td><?= h($stars->id) ?></td>
                        <td><?= h($stars->user_id) ?></td>
                        <td><?= h($stars->post_id) ?></td>
                        <td><?= h($stars->star_score) ?></td>
                        <td><?= h($stars->created) ?></td>
                        <td><?= h($stars->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Stars', 'action' => 'view', $stars->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Stars', 'action' => 'edit', $stars->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stars', 'action' => 'delete', $stars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stars->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
