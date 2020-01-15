<?php

namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');

        // $this->loadModel('Users');
        $this->loadModel('Favorites');
        $this->loadModel('Stars');

        $this->set('authuser', $this->Auth->user());

        $this->viewBuilder()->setLayout('minibbs');
    }

    // トップページ
    public function index()
    {
        // 投稿メッセージの表示
        $this->paginate = [
            'contain' => ['Users', 'Favorites', 'Stars'],
            'order' => ['created' => 'desc'],
            'limit' => 10,
        ];
        $minibbsPosts = $this->paginate($this->Posts);

        $this->set(compact('minibbsPosts'));

        // 投稿フォーム（Add）
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData()); // 既存のエンティティにマージ

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
        }

        // 返信（Reply）
        if ($this->request->query('reply')) {
            $post->reply_message_id = $this->request->query('reply');

            $replySource = $this->Posts->get($post->reply_message_id, [
                'contain' => 'Users',
            ]);
            $post->messages = '@' . $replySource->user->username . ' Re: ' . $replySource->messages . ' ＞ ';
        }

        $this->set(compact('post'));
    }

    public function view(int $id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Favorites', 'Stars'],
        ]);

        $replyPosts = $this->Posts
            ->find()
            ->contain(['Users'])
            ->where(['reply_message_id' => $id])
            ->order(['Posts.created' => 'desc'])
            ->all();

        $this->set(compact('post', 'replyPosts'));
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
