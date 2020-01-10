<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'login',
            'signup',
            'logout',
        ]);

        $this->viewBuilder()->setLayout('minibbs');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // ユーザー情報の入力内容確認画面へ移行
            if ($this->request->data['mode'] === 'confirm') {

                // アイコン画像をアップロード
                if (! empty($this->request->data['icon']['tmp_name'])) {
                    $tmpName = $this->request->data['icon']['tmp_name'];
                    $dir = realpath(WWW_ROOT . "/img/user-icon");
                    $iconFileName = date('YmdHis') . $this->request->data['icon']['name'];

                    move_uploaded_file($tmpName, $dir . '/' . $iconFileName);
                } else {
                    $iconFileName = '100x100.png';
                }

                $checkdata = $this->request->data;
                $checkdata['icon_file_name'] = $iconFileName;
                $session = $this->request->session()->write('username', $checkdata['username']);
                $this->set(compact('checkdata', 'session'));

                $this->render('confirm');

            // ユーザー情報を登録する
            } elseif ($this->request->data['mode'] === 'savedata') {
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    $this->request->session()->destroy();

                    return $this->redirect([
                        'action' => 'login',
                    ]);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }
}
