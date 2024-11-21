<?php
namespace App\Controllers;

use DB\Database; 

class TodoController {
    public function index(){

        // Récupérer l'instance de connexion à la DB
        $db = Database::getInstance();

        //Récupérer les tâches depui la BDD
        $query = $db->query("SELECT * FROM todos;"); //prépare la qequête
        $todos = $query->fetchAll(); // retourne le résultat de l'exécution de la requête
      
        //Charger la Vue "Views/index.php"
        // require __DIR__ ."/../Views/index.php"; 
        require dirname(__DIR__) ."/Views/index.php"; //Renvoie le dossier parent du dossier parent

    }


    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);
            
            if ($task) {            
               //Récupérer l'instance de connexion à la BDD
               $db = Database::getInstance();
               // Prépare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
               // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
               //Cela sécurise les données entrées par l'utilisateur.
               $stmt = $db->prepare("INSERT INTO todos (task,done) VALUES(:task, :done)"); //prépare la requête
               
               // Exécute de la requête préparée avec des valeurs spécifiques  fournies dans un tableau associatif
               // - `:task` contient la description de la tâche saisie par l'utilisateur
               // - `:done`  est initialisée à  zéro (indiquant que ma tâche n'est pas encore terminée).
               $stmt->execute([":task" =>$task, ":done" => 0]);
            //    $stmt->execute(["task" =>$task, "done" => 0]); // on peut retirer les ":" des placeholders , c'ets pareil
            }
            header('Location: /');
            exit;
        }
        // Charhger la vue add.php
        require dirname(__DIR__) ."/Views/add.php";
    }
     
    public function delete(){

        $id = $_GET['id'] ?? null;

        if ($id) {
           // Récupérer l'instance de connexion à la DB
            $db = Database::getInstance();
            $stmt = $db->prepare("DELETE FROM todos WHERE id = :id;"); //$stmt pour "prepared statement" en anglais, "requête préparée" en français donc stmt === statement.
           // 
            $stmt->execute(["id" => (int) $id]);
           
            };
        
        header('Location: /');
        exit;
    }

    public function toggle() {
        $id = $_GET['id'] ?? null;
        if ($id) {
        // Récupérer l'instance de connexion à la DB
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        $stmt->execute(["id" => (int) $id]);
        }
    
        header('Location: /');
        exit;
    }

    public function update() {
       
    header('Location: /');
    exit;
}
}