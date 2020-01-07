<?php if ($this->request->action === 'login') : ?>
    <h1>
        <?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?>
    </h1>
<?php else : ?>
    <h1>
        <?= $this->Html->link(__('Minibbs'), ['controller' => 'Minibbs', 'action' => 'index']) ?>
    </h1>
<?php endif; ?>

<?php if ($this->request->action === 'login') : ?>
    <div class="header-button">
        <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'add']) ?>
    </div>
<?php else : ?>
    <div class="header-button">
        <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
    </div>
<?php endif; ?>
