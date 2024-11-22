<?php
use App\Controllers\TodoController;
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
$router->get("/", [$todoController, 'index']);
$router->get("/add", [$todoController, 'add']);
$router->post("/add", [$todoController, 'add']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/delete", [$todoController, 'delete']);
$router->get("/update", [$todoController, 'update']);
$router->post("/update", [$todoController, 'update']);

//Résoudre la route corespondante
$router->resolve();
