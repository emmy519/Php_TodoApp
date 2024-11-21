<?php
namespace App\Models;

use DB\Database;

class Model{
    protected $db;

    public function __construct(){
                 // Récupérer l'instance de connexion à la DB
        $this->db = Database::getInstance();
    }
}