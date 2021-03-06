<?php if (! $post) : ?>
    <p>この投稿は削除されたか、URLが間違っています。</p>
    <p class="view-button">
        <?= $this->Html->link(__('戻る'), [
            'controller' => 'Posts',
            'action' => 'index',
        ], [
            'class' => 'cancel-button'
        ]) ?>
    </p>
<?php else : ?>
    <div class="msg">
        <p>
            <?= $this->Html->image('user-icon/' . $post->user->icon_file_name, ['alt' => $post->user->username . 'のアイコン']); ?>
        </p>
        <p class="post-message">
            <?= h($post->messages) ?><span class="name">（<?= h($post->user->username) ?>）</span>
        </p>
        <p class="day">
            <?= h($post->created) ?>
        </p>
    </div><!-- msg -->
    <?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user->id) : ?>
        <p class="view-button">
            <?= $this->Html->link(__('投稿を編集する'), [
                'action' => 'edit',
                $post->id
            ], [
                'class' => 'cancel-button',
            ]) ?>
        </p>
    <?php endif; ?>
    <p class="view-button">
        <?= $this->Html->link(__('戻る'), [
            'controller' => 'Posts',
            'action' => 'index',
        ], [
            'class' => 'cancel-button'
        ]) ?>
    </p>
    <?php if (!$replyPosts->isEmpty()) : ?>
        <div class="reply-container">
            <?php foreach ($replyPosts as $replyPost) : ?>
                <div class="msg -reply">
                    <p>
                        <?= $this->Html->image('user-icon/' . $replyPost->user->icon_file_name, ['alt' => $replyPost->user->username . 'のアイコン']); ?>
                    </p>
                    <p class="post-message">
                        <?= h($replyPost->messages) ?><span class="name">（<?= h($replyPost->user->username) ?>）</span>
                    </p>
                    <p class="day">
                        <?= h($replyPost->created) ?>
                    </p>
                </div><!-- msg -->
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
