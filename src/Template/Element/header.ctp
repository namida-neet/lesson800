<?php if ($this->request->controller === 'Login') : ?>
    <h1>
        <?= $this->Html->link(__('Login'), ['controller' => 'Login', 'action' => 'index']) ?>
    </h1>
<?php elseif ($this->request->action === 'signup') : ?>
    <h1>
        <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'signup']) ?>
    </h1>
<?php else : ?>
    <h1>
        <?= $this->Html->link(__('Minibbs'), ['controller' => 'Posts', 'action' => 'index']) ?>
    </h1>
<?php endif; ?>

<?php if ($this->request->controller === 'Login') : ?>
    <div class="header-button">
        <?= $this->Html->link(__('Sign up'), ['controller' => 'Users', 'action' => 'signup']) ?>
    </div>
<?php elseif ($this->request->action === 'signup') : ?>
    <div class="header-button">
        <?= $this->Html->link(__('Login'), ['controller' => 'Login', 'action' => 'index']) ?>
    </div>
<?php else : ?>
    <div class="header-button">
        <?= $this->Html->link(__('Logout'), ['controller' => 'Logout', 'action' => 'index']) ?>
    </div>
<?php endif; ?>
