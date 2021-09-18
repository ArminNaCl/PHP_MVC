<?php



use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
    ];

$app = new Application(dirname(__DIR__),$config); 
 


 
//first  rendering hello world
// $router = new Router();
// $router->get('/',function(){
//     return 'hello world!';
// });

// $app ->userRouter($router);
//       
$app->router->get('/',[SiteController::class,'home']);

// $app->router->get('/contact',function(){return "Contact"; });
$app->router->get('/contact','contact');
// $app->router->get('/contact',[SiteController::class, 'contact']);



$app->router->post('/contact',[SiteController::class,'handleContact']); 
// $app->router->post('/contact',function(){
//     return 'handling submitted';
// }); 

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);
 


$app->run();











?>