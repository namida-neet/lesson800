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
  <?= $this->element('messageform', ['post' => $post, 'action' => 'index']) ?>
  <!-- 投稿フォームここまで -->
</div><!-- post-area -->

<!-- 投稿一覧表示 -->
<?php foreach ($minibbsPosts as $minibbsPost) : ?>
  <?= $this->element('article', ['minibbsPost' => $minibbsPost]) ?>
<?php endforeach; ?>
<!--投稿一覧表示ここまで-->

<!--ページネーション-->
<ul class="paging">
  <?= $this->Paginator->first('<< ' . __('first')) ?>
  <?= $this->Paginator->prev('< ' . __('previous')) ?>
  <?= $this->Paginator->numbers() ?>
  <?= $this->Paginator->next(__('next') . ' >') ?>
  <?= $this->Paginator->last(__('last') . ' >>') ?>
</ul>
<!--ページネーションここまで-->
