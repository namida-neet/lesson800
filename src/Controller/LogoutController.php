<?php

namespace App\Controller;

use App\Controller\AppController;


class LogoutController extends AppController
{
    public function index()
    {
        return $this->redirect($this->Auth->logout());
    }
}
