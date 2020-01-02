<?php
namespace App\Controller;

use App\Controller\AppController;

class MinibbsController extends AppController
{
    public $useTable = false;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');

        $this->loadModel('Users');
        $this->loadModel('Posts');
        $this->loadModel('Favorite');
        $this->loadModel('Star');

        $this->set('authuser', $this->Auth->user());

        $this->viewBuilder()->setLayout('minibbs');
    }

    // トップページ
    public function index()
    {
        $posts = $this->paginate('Posts', [
            'contain' => ['Users'],
            'order' => ['created' => 'desc'],
            'limit' => 5,
        ]);

        $this->set(compact('posts'));
    }
}
