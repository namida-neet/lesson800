<?php if (isset($post)) : ?>
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
<?php else : ?>
<p>この投稿は削除されたか、URLが間違っています。</p>
<?php endif; ?>
<?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user->id) : ?>
<p>
  <?= $this->Html->link(__('投稿を編集する'), [
      'action' => 'edit',
      $post->id
  ], [
      'class' => 'cancel-button',
  ]) ?>
</p>
<?php endif; ?>
<p>
  <?= $this->Html->link(__('戻る'), [
      'controller' => 'Minibbs',
      'action' => 'index',
  ], [
      'class' => 'cancel-button'
  ]) ?>
</p>
