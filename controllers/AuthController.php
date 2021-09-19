<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\core\Application;



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
        $user = new User();
        if ($request->isPost()){
            $user->loadData($request->getBody());
            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success','Thanks for Registering');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('register',[
                'model' => $user
            ]);
        }
        return $this->render('register',[
            'model' => $user,
            // 'errors' => $errors
        ]);
    }

}