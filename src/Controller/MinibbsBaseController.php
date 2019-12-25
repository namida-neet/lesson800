<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

class MinibbsBaseController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authorize' => [
                'Controller',
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password',
                    ],
                ],
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout',
            ],
            'authError' => 'ログインしてください。',
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'login',
        ]);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again.'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    // 認証時のロールの処理
    public function isAuthorized($user = null)
    {
        // 管理者
        if ($user['role'] === 'admin') {
            return true;
        }
        // ユーザー
        if ($user['role'] === 'author') {
            return true;
        }

        // その他はすべてfalse
        return false;
    }
}
