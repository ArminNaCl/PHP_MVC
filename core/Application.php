<?php

namespace app\core;

  

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;
    public static Application $app;
    public Controller $controller;
    public ?DbModel $user;

    public string $userClass;

    public function __construct($rootPath,array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->session = new Session();
        $this->router =new Router($this->request,$this->response);
        
        $this->db = new Database($config['db']);

        $primaryValue= $this->session->get('user');
        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user =$this->userClass::findOne([$primaryKey=>$primaryValue]);
        } else {
            $this->user=null;
        }
    }

    public function setController($controller){
        $this->controller = $controller;
    }

    public function getController($controller){
        return $this->controller;
    }

    public function login(DbModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(){
        return !self::$app->user;
    }



    public function run(){
        echo $this->router->resolve();
         
    }
}