<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * PostsController
 */

class LoginController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('minibbs');
    }

    public function index()
    {
        if ($this->Auth->isAuthorized()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
}
