<?php
namespace Database\Migrations;

require dirname(__DIR__) ."/../vendor/autoload.php";

use DB\Database;

//Récupérer l'instance de cinnexion à la BDD
$db = Database::getInstance();


$queries = [
    "CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    done TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($queries as $query) {
    $db->exec($query);
    echo "Migration exécutée: $query" . PHP_EOL;
}

echo "Migration terminée avec succès";