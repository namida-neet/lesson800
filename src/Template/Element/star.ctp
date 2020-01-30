<?php $searchStar = array_search($authuser['id'], array_column($minibbsPost->stars, 'user_id'), true) ?>
<div class="star">
    <?php if ($searchStar === false) : ?>
        <?= $this->Form->create(null, [
            'type' => 'post',
            'url' => [
                'controller' => 'Stars',
                'action' => 'add',
            ],
        ]) ?>
    <?php else : ?>
        <?= $this->Form->create(null, [
            'type' => 'post',
            'url' => [
                'controller' => 'Stars',
                'action' => 'edit',
            ],
        ]) ?>
    <?php endif; ?>
    <?php
        echo $this->Form->hidden('user_id', ['value' => $authuser['id']]);
        echo $this->Form->hidden('post_id', ['value' => $minibbsPost->id]);
    ?>
    <?= $this->Form->button('', [
        'class' => 'fas fa-minus-circle',
        'name' => 'zero'
    ]) ?>
    <?= $this->Form->button('', [
        'class' => 'far fa-smile',
        'name' => 'one'
    ]) ?>
    <?= $this->Form->button('', [
        'class' => 'far fa-laugh-beam',
        'name' => 'two'
    ]) ?>
    <?= $this->Form->button('', [
        'class' => 'far fa-grin-squint-tears',
        'name' => 'three'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
<p class="starAverage">
    <?php $starAverage = $this->Number->precision($minibbsPost->stars_score, 0) ?>
    <?php if ($minibbsPost->stars_score > 2) : ?>
        <i class="far fa-grin-squint-tears"></i>
    <?php elseif ($minibbsPost->stars_score > 1) : ?>
        <i class="far fa-laugh-beam"></i>
    <?php else : ?>
        <i class="far fa-smile"></i>
    <?php endif; ?>
</p>
