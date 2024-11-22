<?php
namespace App\Controllers;

use App\Models\Todo;
use DB\Database;
class TodoController extends Controller {

    private Todo $todoModel;
     
    public function __construct() {
        $this->todoModel = new Todo();
    }

    public function index(){

        UserController::checkAuth();
         $todos = $this->todoModel->getAll();
        //Charger la Vue "Views/index.php"
        // require __DIR__ ."/../Views/index.php"; 
        // require dirname(__DIR__) ."/Views/index.php"; //Renvoie le dossier parent du dossier parent
        $this->view("index", ["data" => $todos] );
    }


    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);
            
            if ($task) {   
                
                $this->todoModel->add($task);
               
            }
            $this->redirect("/home");
            
        }

        // Charhger la vue add.php
        // require dirname(__DIR__) ."/Views/add.php";
        $this->view("add");

    }
     
    public function delete(){

        $id = $_GET['id'] ?? null;

        if ($id) {
          $this->todoModel->delete((int) $id);
            };
        
            $this->redirect("/home");

    }

    public function toggle() {
        $id = $_GET['id'] ?? null;
        if ($id) {
       $this->todoModel->toggle((int) $id);
        }
    
        $this->redirect("/home");

    }

    public function update()
    {
        // Vérifier si l'ID de la tâche est fourni dans la requête GET ou POST
        $id = $_GET['id'] ?? $_POST['id'] ?? null; // Ajouter $_POST['id'] pour récupérer l'ID envoyé via POST

        if ($id) {
            // Trouver la tâche à modifier en récupérant l'élément avec cet ID
            $todoToEdit = $this->todoModel->getById((int)$id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer la nouvelle tâche depuis le formulaire
                $newTask = trim($_POST['task']);

                if ($newTask && $id) {
                    // Mettre à jour la tâche avec le nouvel intitulé
                    $this->todoModel->update((int)$id, $newTask);

                    // Rediriger vers la page d'accueil après la mise à jour
                    $this->redirect('/home');
                } else {
                    $this->redirect('/update?id=' . $id);  // Redirige vers le formulaire avec l'ID de la tâche
                }
            }

            // Si la méthode est GET, on affiche le formulaire de modification avec les données actuelles
            if ($todoToEdit) {
                $this->View("update", ["todoEdit" => $todoToEdit]);  // Passer la tâche sous la clé "todoEdit"
            } else {
                // Si la tâche n'existe pas, rediriger vers la page d'accueil
                $this->redirect('/home');
            }
        } else {
            // Si l'ID n'est pas fourni, rediriger vers la page d'accueil
            $this->redirect('/home');
        }
    }

    

}
