<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;



class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('Auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $this->setLayout('Auth');
        if ($request->isPost()){
            return "handle subited data";
        }
        return $this->render('register');
    }

}