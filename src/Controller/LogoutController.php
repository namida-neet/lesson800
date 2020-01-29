<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * PostsController
 */

class LogoutController extends AppController
{
    public function index()
    {
        return $this->redirect($this->Auth->logout());
    }
}
