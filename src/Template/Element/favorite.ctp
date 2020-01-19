<?php $searchFavorite = array_search($authuser['id'], array_column($minibbsPost->favorites, 'user_id'), true) ?>
<?php if ($searchFavorite === false) : ?>
    <div class="favorite">
        <?= $this->Form->create('', [
            'url' => [
                'controller' => 'Favorites',
                'action' => 'add',
            ],
            ]) ?>
        <?php
            echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
            echo $this->Form->hidden('post_id', ['value' => $minibbsPost->id]);
        ?>
        <?= $this->Form->button('', [
            'class' => 'far fa-heart'
            ]) ?>
        <?= $this->Form->end() ?>
    </div>
<?php else : ?>
    <div class="favorite">
        <?= $this->Form->create('', [
            'url' => [
                'controller' => 'Favorites',
                'action' => 'delete',
            ],
        ]) ?>
        <?php
            echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
            echo $this->Form->hidden('post_id', ['value' => $minibbsPost->id]);
        ?>
        <?= $this->Form->button('', [
            'class' => 'fas fa-heart'
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif; ?>
<p class="favCount">
    <?php if (!isset($minibbsPost->favorites_count)) : ?>
        0
    <?php else : ?>
        <?= $this->Number->format($minibbsPost->favorites_count) ?>
    <?php endif; ?>
</p>
