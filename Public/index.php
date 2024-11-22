<?php
use App\Controllers\TodoController;
use App\Controllers\UserController;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";


//Démarrer la session
if(!isset($_SESSION)){
    session_start();
}
//Créer une instance du router
$router = new Router();

//Créer une insatnce du TodoController
$todoController = new TodoController();
//Définir les routes de l'application
$router->get("/home", [$todoController, 'index']);
$router->get("/add", [$todoController, 'add']);
$router->post("/add", [$todoController, 'add']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/delete", [$todoController, 'delete']);
$router->get("/update", [$todoController, 'update']);
$router->post("/update", [$todoController, 'update']);




// Créer une instance de UserController
$userController = new UserController();

// Définir les routes
// $router->get("/login", [$userController, 'login']);
// $router->post("/register", [$userController, 'register']);

$router->get('/', [$userController, 'showLoginForm']);
$router->post('/login', [$userController, 'processLogin']);
$router->get('/register', [$userController, 'showRegisterForm']);
$router->post('/register', [$userController, 'processRegister']);



//Résoudre la route corespondante
$router->resolve();
