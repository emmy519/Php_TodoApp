<?php
namespace App\Controllers;

class TodoController {
    public function index(){
        //Récupérer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); //Récupérer la session existante
        }

        $todos = $_SESSION["todos"];
        
        //Charger la Vuye "Views/index.php"
        require __DIR__ ."/../Views/index.php"; 
        require dirname(__DIR__) ."/Views/index.php"; //Renvoie le dossier parrent du dossier parent

    }

    public function add() {

    }
     
    public function delete(){

    }

    public function toggle() {

    }
}