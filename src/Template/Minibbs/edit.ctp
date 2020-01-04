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
        <p><?= $this->Html->link(__('戻る'), ['action' => 'view', $post->id]) ?></p>
    </div>
<?php endif; ?>
