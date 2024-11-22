<?php
namespace App\Models;


class Todo extends Model {
    /**
     * Récupère toutes les tâches dans la BDD
     * @return array
     */
    public function getAll() {
 
         //Récupérer les tâches depui la BDD
         $query = $this->db->query("SELECT * FROM todos;"); //prépare la qequête
         return $query->fetchAll(); // retourne le résultat de l'exécution de la requête
       
    }
    public function add(string $task) {
               
         // Prépare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
         // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
         //Cela sécurise les données entrées par l'utilisateur.
         $stmt = $this->db->prepare("INSERT INTO todos (task,done) VALUES(:task, :done)"); //prépare la requête
         
         // Exécute de la requête préparée avec des valeurs spécifiques  fournies dans un tableau associatif
         // - `:task` contient la description de la tâche saisie par l'utilisateur
         // - `:done`  est initialisée à  zéro (indiquant que ma tâche n'est pas encore terminée).
         return $stmt->execute([":task" =>$task, ":done" => 0]);
      //    $stmt->execute(["task" =>$task, "done" => 0]); // on peut retirer les ":" des placeholders , c'ets pareil
     
    }

    /**
     * Change le statut d'une tâche (comme terminée | pas terminée)
     * @param int $id l'identifiant de la tâche à supprimer
     * @return void
     */
    public function toggle(int $id) {

        $stmt = $this->db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        $stmt->execute(["id" => (int) $id]);
    }

    /**
     * SUpprime une tâche
     * @param int $id L'identifiant de la tâche à supprimer
     * @return bool
     */
    public function delete(int $id) {

        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id;"); //$stmt pour "prepared statement" en anglais, "requête préparée" en français donc stmt === statement.
        return $stmt->execute(["id" => (int) $id]);

    }
}