<?php $searchFavorite = array_search($authuser['id'], array_column($minibbsPost->favorites, 'user_id'), true) ?>
<?php if ($searchFavorite === false) : ?>
    <div class="favorite" id="addfavorite<?php echo h($minibbsPost->id) ?>">
<?php else : ?>
    <div class="favorite hide" id="addfavorite<?php echo h($minibbsPost->id) ?>">
<?php endif; ?>
        <?= $this->Form->create('null', [
            'url' => [
                'controller' => 'Favorites',
                'action' => 'add',
            ],
            'class' => 'favorite-form'
        ]) ?>
        <?php
            echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
            echo $this->Form->hidden('post_id', ['value' => $minibbsPost->id]);
        ?>
        <?= $this->Form->button('', [
            'class' => 'far fa-heart favorite-add-button',
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
<?php if ($searchFavorite !== false) : ?>
    <div class="favorite" id="deletefavorite<?php echo h($minibbsPost->id) ?>">
<?php else : ?>
    <div class="favorite hide" id="deletefavorite<?php echo h($minibbsPost->id) ?>">
<?php endif; ?>
        <?= $this->Form->create('null', [
            'url' => [
                'controller' => 'Favorites',
                'action' => 'delete',
            ],
            'class' => 'favorite-form',
        ]) ?>
        <?php
            echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
            echo $this->Form->hidden('post_id', ['value' => $minibbsPost->id]);
        ?>
        <?= $this->Form->button('', [
            'class' => 'fas fa-heart favorite-delete-button',
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
<p class="favCount" id="favCount<?php echo h($minibbsPost->id) ?>">
    <?= $this->Number->format(count($minibbsPost->favorites)) ?>
</p>
