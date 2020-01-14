<?php if ($authuser['role'] === 'admin' || $authuser['id'] === $post->user_id) : ?>
  <div class="post-area">
    <div class="user-info">
      <p class="user-icon">
        <?= $this->Html->image('user-icon/' . $authuser['icon_file_name'], ['alt' => $authuser['username'] . 'のアイコン']); ?>
      </p>
      <p class="user-name">
        <?= $authuser['username'] ?>
      </p>
    </div><!-- user-info -->

    <!-- 投稿フォーム -->
    <?= $this->Form->create($post, [
      'class' => 'bbs-form',
    ]) ?>
    <?= $this->Form->control('messages', [
      'label' => false,
      'class' => 'bbs-textarea',
    ]) ?>
    <?= $this->Form->submit(__('Submit'), [
      'class' => [
        'submit-button',
        '-bbs-message',
      ],
    ]) ?>
    <!-- 投稿フォームここまで -->
  </div><!-- post-area -->
  <?= $this->Form->end() ?>
<?php else : ?>
  <p>この記事を編集する権限がありません。</p>
<?php endif; ?>
<p>
  <?= $this->Html->link(__('戻る'), [
    'action' => 'view',
    $post->id
  ], [
    'class' => 'cancel-button',
  ]) ?>
</p>
