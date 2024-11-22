<?php
namespace App\Controllers;

abstract class Controller {

    protected function view(string $view, $data = []) {
        extract($data);
        //Renvoie le dossier parent du dossier parent
        require dirname(__DIR__) ."/Views/$view.php"; 
    }

    /**
     * Méthode pour rediriger vers l'url
     * @param string $url URL de redirection
     * @return never
     */
    protected function redirect(string $url) {
        header("Location: $url");
        exit;
    }
}