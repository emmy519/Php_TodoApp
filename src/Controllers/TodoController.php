<?php
namespace App\Controllers;

class TodoController {
    public function index(){
        //Récupérer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); //Récupérer la session existante
        }

        $todos = $_SESSION["todos"] ?? []; // SI $todos est NULL on prend le tableau vide
        
        //Charger la Vue "Views/index.php"
        // require __DIR__ ."/../Views/index.php"; 

        require dirname(__DIR__) ."/Views/index.php"; //Renvoie le dossier parent du dossier parent

    }

    public function add() {

    }
     
    public function delete(){

    }

    public function toggle() {

    }
}