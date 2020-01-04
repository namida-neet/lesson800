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
        // 投稿されたメッセージの表示
        $minibbsPosts = $this->paginate('Posts', [
            'contain' => ['Users', 'Favorites', 'Stars'],
            'order' => ['created' => 'desc'],
            'limit' => 5,
        ]);

        $this->set(compact('minibbsPosts'));

        // 投稿フォーム（Add）
        if ($this->request->is('post')) {
            $message = $this->request->data['Posts'];
            $post = $this->Posts->newEntity($message);

            $post->user_id = $this->Auth->user('id');

            if (! isset($post->reply_message_id)) {
                $post->reply_message_id = null;
            }

            $post->repost_message_id = null;

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));

        } else {
            $post = $this->Posts->newEntity();
        }

        // 返信（Reply）
        if ($this->request->query('reply')) {
            $post = $this->Posts->newEntity();

            $post->reply_message_id = $this->request->query('reply');

            $replySource = $this->Posts->get($post->reply_message_id, [
                'contain' => 'Users',
            ]);
            $post->messages = '@' . $replySource->user->username . ' Re: ' . $replySource->messages . ' ＞ ';
        }

        $this->set(compact('post'));
    }

    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Favorites', 'Stars'],
        ]);

        $this->set('post', $post);
    }
}
