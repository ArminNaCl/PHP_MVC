<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\core\Application;
use app\models\LoginForm;



class AuthController extends Controller
{
    public function login(Request $request,Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()){
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('Auth');
        return $this->render('login',[
            'model' => $loginForm
        ]);
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

    public function logout(Request $request,Response $response){
        Application::$app->logout();
        $response->redirect('/');

    }

}