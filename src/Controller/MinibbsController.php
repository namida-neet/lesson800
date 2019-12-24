<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Exception;

class MinibbsController extends MinibbsBaseController
{
    public $useTable = false;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');

        $this->loadModel('Users');
        $this->loadModel('Posts');
        $this->loadModel('Favorites');
        $this->loadModel('Stars');

        // ログインしているユーザ情報をauthuserに設定
        $this->set('authuser', $this->Auth->user());

        $this->viewBuilder()->setLayout('minibbs');
    }

    // トップページ
    public function index()
    {
        // メッセージの投稿フォームが必要

        // メッセージの表示
        $minibbsPosts = $this->paginate('Posts', [
            'contain' => ['Users'],
            'order' => [
                'id' => 'desc', // 変える
            ],
            'limit' => '2', // 変える
        ]);

        $this->set(compact('minibbsPosts'));
    }

    // メッセージの個別の詳細ページ
    public function view($id = null)
    {
        $posts = $this->Posts->get($id, [
            'contain' => [
                'Users',
//                'Favorites',
//                'Stars',
            ],
        ]);
    }
}
