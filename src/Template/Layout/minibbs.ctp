<!doctype html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->name . '/' . $this->request->action ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('minibbs.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <h1><?= $this->Html->link(__('minibbs'), ['action' => 'index']) ?></h1>
    </header>
    <main>
        <?= $this->Flash->render() ?><!--これなに-->
        <div>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
        <nav class="paginator">
            <ul class="pagination">
                <li><?= $this->Paginator->first('|<< ') ?></li>
                <li><?= $this->Paginator->prev('< ') ?></li>
                <li><?= $this->Paginator->numbers() ?></li>
                <li><?= $this->Paginator->next(' >') ?></li>
                <li><?= $this->Paginator->last(' >>|') ?></li>
            </ul>
        </nav>
    </footer>
</body>
</html>
