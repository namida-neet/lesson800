<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--  $this->Html->css('base.css')  -->
    <!--  $this->Html->css('style.css')  -->
    <?= $this->Html->css('minibbs') ?>
    <?= $this->Html->css('flashmessage') ?>
    <?= $this->Html->css('user-icon-dnd-area') ?>
    <script src="https://kit.fontawesome.com/ccf5e700a2.js" crossorigin="anonymous"></script>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') ?>
</head>

<body>
    <?= $this->Flash->render() ?>
    <div id="wrap">
        <header id="head">
            <?= $this->element('header') ?>
        </header>
        <div id="content">
            <?= $this->fetch('content') ?>
        </div>
    </div>
<?= $this->Html->script('message-max-length') ?>
<?= $this->Html->script('favorite-button-change') ?>
<?= $this->Html->script('user-icon-dnd') ?>
</body>

</html>
