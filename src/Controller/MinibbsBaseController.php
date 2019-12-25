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

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => [
                'Controller',
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'passowrd' => 'password',
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

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if (!empty($user)) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザ名かパスワードが間違っています。');
        }
    }

    public function logout()
    {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    // 認証しないページの設定
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([]); // AppControllerも含めて変更する必要がありそう
    }

    // 認証時のロールの処理
    public function isAuthorized($user = null)
    {
        // 管理者
        if ($user['role'] === 'admin') {
            return true;
        }

        // 一般ユーザはMinibbsControllerのみ ここ変更する必要あります
        if ($user['role'] === 'author') {
//            if ($this->name === 'Minibbs') { // 書籍は==になっているけどなぜ
//                return true;
//            } else {
//                return false;
//            }
            return true;
        }

        // その他はすべてfalse
        return false;
    }
}
