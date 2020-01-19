<?php
namespace App\Controller;

use App\Controller\AppController;

class MinibbsController extends AppController
{
    public $useTable = false;

    public $paginate = [];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');

        $this->loadModel('Users');
        $this->loadModel('Posts');
        $this->loadModel('Favorites');
        $this->loadModel('Stars');

        $this->set('authuser', $this->Auth->user());

        $this->viewBuilder()->setLayout('minibbs');
    }

    // トップページ
    public function index()
    {
        // 投稿されたメッセージの表示
        $query = $this->Posts->find()
            ->contain(['Users', 'Favorites', 'Stars'])
            ->order(['Posts.created' => 'desc'])
            ->limit(10);
            // ->where(['Favorites.user_id' => $this->Auth->user('id')]);



        // $findFavoritesQuery = $this->Favorites->find()
        //     ->contain(['Posts'])
        //     ->where(['Favorites.user_id' => $this->Auth->user('id')]);
        // $favorites = $this->paginate($findFavoritesQuery);

        $minibbsPosts = $this->paginate($query);

        $this->set(compact('minibbsPosts'));

        // 投稿フォーム（Add）
        if ($this->request->is('post')) {
            $message = $this->request->getData();
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

    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [],
        ]);

        if ($this->Auth->user('role') === 'admin' || $this->Auth->user('id') && $post->user_id) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $post = $this->Posts->patchEntity($post, $this->request->getData());
                if ($this->Posts->save($post)) {
                    $this->Flash->success(__('The post has been saved.'));

                    return $this->redirect(['action' => 'view', $id]);
                }
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('この記事を編集する権限がありません。'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $this->set(compact('post'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);

        if ($this->Auth->user('role') === 'admin' || $this->Auth->user('id') && $post->user_id) {
            if ($this->Posts->delete($post)) {
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('この記事を削除する権限がありません。'));
            return $this->redirect(['action' => 'index']);
        }

        return $this->redirect(['action' => 'index']);
    }
}