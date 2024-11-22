<?php
namespace DB;

use Dotenv\Dotenv;
use \PDO;
use \PDOException;

class Database {

    // Design Pattern: Singleton
    public static ?PDO $instanceDb = null;

    // Configuration de la Base De Données
      
     
    /**
     * Empêche l'instanciation de la classe
     */
    private function __construct() 
    {        
    }
    private function __clone() 
    {
    } // Fonction magique s'exécutant automatiquement, crée une copie pour faire simple.
    public static function getInstance() {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__ ));
        $dotenv->load();

        
        //Configuration de la base de données 
        $dbHost = $_ENV["DB_HOST"];
        $dbName = $_ENV["DB_NAME"];
        $dbUser = $_ENV["DB_USER"];
        $dbPassword = $_ENV["DB_PASSWORD"];

        
        // si l'instance est nulle on la cré
        if (self::$instanceDb === null) {
            try {
                self::$instanceDb = new PDO(
                    "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
                    $dbUser,
                    $dbPassword,
                    [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // lever les exceptions quand il y a des erreurs
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //renvoyer les données sous forme de tableau associatif
                    ]       
                            
                );
            } catch (PDOException $e) {
                exit("Echec de connexion à la DB: " . $e->getMessage());
                
            };
        }

        // sinon, on la renvoie directement,
        return self::$instanceDb;
    }   

    //  /**
    //  * Ferme la connexion à la base de données
    //  */
    // public static function closeInstance(): void {
    //     self::$instanceDb = null;
    // }

    
}