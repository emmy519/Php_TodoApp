<?php
namespace Database\Migrations;

require dirname(__DIR__) ."/../vendor/autoload.php";

use DB\Database;

//Récupérer l'instance de cinnexion à la BDD
$db = Database::getInstance();


$queries = [
    //Creation de la table todos
    "CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    done TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    // Création de la table users
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    // Ajouter la colonne user_id dans la table todos et la clé étrangère
    "ALTER TABLE todos 
        ADD COLUMN user_id INT NOT NULL,
        ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE"

];

foreach ($queries as $query) {
    $db->exec($query);
    echo "Migration exécutée: $query" . PHP_EOL;
};

// Fermer la connexion après les migrations
// Database::closeInstance();

echo "Migration terminée avec succès";