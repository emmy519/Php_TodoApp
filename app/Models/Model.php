<?php
namespace App\Models;

use DB\Database;

abstract class Model{
    protected $db;

    public function __construct(){
        // Récupérer l'instance de connexion à la DB
        $this->db = Database::getInstance();
    }
}


// La classe Model n'est pas destinée à être instanciée